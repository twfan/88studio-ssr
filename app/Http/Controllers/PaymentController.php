<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationVtuber;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
   public function create(Request $request) {
    $data = json_decode($request->getContent(), true);
    $paypalClient = new PayPalClient;
    $paypalClient->setApiCredentials(config('paypal'));
    $token = $paypalClient->getAccessToken();
    $paypalClient->setAccessToken($token);

    $transaction = Transaction::find($data['transaction_id']);
    $order = $paypalClient->createOrder([
        "intent"=> "CAPTURE",
        "purchase_units"=> [
                [
                "amount"=> [
                    "currency_code"=> "USD",
                    "value"=> $data['amount']
                ],
                    'description' => 'test'
            ]
        ],
    ]);
    // $mergeData = array_merge($data,['status' => TransactionStatus::PENDING, 'vendor_order_id' => $order['id']]);
    $transaction->order_id_paypall = $order['id'];
    DB::beginTransaction();
    $transaction->save();
    DB::commit();
    return response()->json($order);


    //return redirect($order['links'][1]['href'])->send();
    // echo('Create working');
   }

   public function createDirectTransaction(Request $request) {
    $data = json_decode($request->getContent(), true);
    $user = User::find($data['user']);
    $paypalClient = new PayPalClient;
    $paypalClient->setApiCredentials(config('paypal'));
    $token = $paypalClient->getAccessToken();
    $paypalClient->setAccessToken($token);

    // $transaction = Transaction::find($data['transaction_id']);
    $product = Product::find($data['product_id']);
    if (!empty($product)) {
        $data['amount'] = $product->price;
    }
    $order = $paypalClient->createOrder([
        "intent"=> "CAPTURE",
        "purchase_units"=> [
                [
                "amount"=> [
                    "currency_code"=> "USD",
                    "value"=> $product->price
                ],
                    'description' => 'test'
            ]
        ],
    ]);
    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->payment = 'unpaid';
    $transaction->payment_method = 'paypal';
    $transaction->transaction_type = Transaction::DIRECT;
    $transaction->sub_total = $product->price;
    $transaction->grand_total = $product->price;
    $transaction->order_id_paypall = $order['id'];

    // $mergeData = array_merge($data,['status' => TransactionStatus::PENDING, 'vendor_order_id' => $order['id']]);
    DB::beginTransaction();
    $transaction->save();

    $transactionDetail = new TransactionDetails();
    $transactionDetail->transaction_id = $transaction->id;
    $transactionDetail->product_id = $product->id;
    $transactionDetail->price = $product->price;
    $transactionDetail->save();
    DB::commit();
    return response()->json($order);


    //return redirect($order['links'][1]['href'])->send();
    // echo('Create working');
   }

   public function captureDirectTransaction(Request $request) 
   {
        $data = json_decode($request->getContent(), true);
        $paypalClient = new PayPalClient;
        $orderId = $data['order_id'];
        $product = Product::find($data['product_id']);
        $paypalClient->setApiCredentials(config('paypal'));
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $result = $paypalClient->capturePaymentOrder($orderId);
        $user = User::find($data['user']);
        
        $transaction = Transaction::where( 'order_id_paypall' ,$orderId)->first();
        try {
            DB::beginTransaction();
            $transaction->payment = Transaction::PAID;
            $transaction->status = Transaction::COMPLETED;
            $transaction->payment_method = Transaction::PAYPAL;
            $transaction->order_id_paypall = $orderId;
            $transaction->payer_id_paypall = $data['payer_id'];
            $transaction->payment_id_paypall = $data['payment_id'];
            $transaction->save();

            Mail::to($request->user()->email)->send(new OrderConfirmationVtuber($transaction, $product));

            $product->sold_out = true;
            $product->user_id = $user->id;
            $product->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return response()->json($result);
   }
   public function capture(Request $request) {
    $data = json_decode($request->getContent(), true);
    $paypalClient = new PayPalClient;
    $orderId = $data['order_id'];
    $paypalClient->setApiCredentials(config('paypal'));
    $token = $paypalClient->getAccessToken();
    $paypalClient->setAccessToken($token);
    $result = $paypalClient->capturePaymentOrder($orderId);

    $transaction = Transaction::find($data['transaction_id']);
    try {
        DB::beginTransaction();
        if($result['status'] === "COMPLETED"){
            $transaction->payment = Transaction::PAID;
            $transaction->status = Transaction::READY;
            $transaction->payment_method = Transaction::PAYPAL;
            $transaction->order_id_paypall = $data['order_id'];
            $transaction->payer_id_paypall = $data['payer_id'];
            $transaction->payment_id_paypall = $data['payment_id'];
            $transaction->save();
            DB::commit();
        }
    } catch (Exception $e) {
        DB::rollBack();
        dd($e);
    }
    return response()->json($result);
   }
}
