<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
