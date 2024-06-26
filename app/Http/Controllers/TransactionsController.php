<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use App\Models\TransactionMessageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;
use Pusher\Pusher;

class TransactionsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $transactions = Transaction::where('user_id', $user->id)->with(['transactionMessages'])->orderBy('id', 'desc')->get();
            return view('member.transaction')->with(['user' => $user, 'transactions' => $transactions]);
        }
    }


    public function paymentConfirmation(String $id)
    {
        $transaction = Transaction::find($id);
        $user =Auth::user();
        return view('member.payment-confirmation', compact('transaction', 'user'));

    }

    public function requestConfirmation(Request $request, String $id) 
    {
        $transaction = Transaction::find($id);
        if (!empty($transaction)) {
            $pathImage = Storage::put('public/transactions/payment-confirmation/'. $transaction->id, $request->file('attachment'), 'public');
            $imageUrl = asset(Storage::url($pathImage));
            $transaction->sender_paypal_email = $request->email;
            $transaction->payment_url = $imageUrl;
            $transaction->status = 'payment_confirmation';
            $transaction->save();
            
            return redirect(route('member.transaction.index'));
        }
    }

    public function invoice(String $id) 
    {
        $transaction = Transaction::where('id', $id)->with(['transactionDetails', 'transactionDetails.product', 'transactionDetails.product.category'])->first();
        $user = Auth::user();
        $client = new Party([
            'name'          => '88 Design Studio',
            'phone'         => '(520) 318-9486',
        ]);
        
        $customer = new Party([
            'name'          => $user->name,
            'custom_fields' => [
                'Email'          => $user->email,
                'Transaction id' => '#' . $transaction->id,
            ],
        ]);

        $statusTransaction = "";
        if ($transaction->status == 'payment_pending') {
            $statusTransaction = 'Pending Payment';
        } else if ($transaction->status == 'paid' || $transaction->status == 'work_in_progress' || $transaction->status == 'finished') {
            $statusTransaction = 'Paid';
        }

        foreach($transaction->transactionDetails as $transactionDetail) {
            $items[] = InvoiceItem::make($transactionDetail['product']['category']['name'])
                ->pricePerUnit($transactionDetail->price);
        }
        
        $notes = [
            'you need to make a payment using paypal before the due date',
            'link for the paypal is paypal.me/eightyeightstudio',
            'after the payment is made, u need to click on payment confirmation button in the website',
            'do take a screenshot of the receipt for payment confirmation',
        ];
        $notes = implode("<br>", $notes);
        
        $invoice = Invoice::make('receipt')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status($statusTransaction)
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('m/d/Y')
            ->payUntilDays(1)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename('Invoice-88studio' . '-' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');
        
        $link = $invoice->url();
        // Then send email to party with link
        
        // And return invoice itself to browser or have a different view
        return $invoice->download();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (Auth::check()) {
            $transaction = Transaction::find($id);
            if ($request->user()->cannot('view', $transaction)) {
                abort(403);
            }
            $user = Auth::user();
            return view('member.transaction-detail', compact('transaction', 'user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadProduct(string $id) 
    {
        $user = Auth::user();
        $transaction = Transaction::find($id);
        if($user->id != $transaction->user_id) {
            abort(403);
        } else {
             return Storage::download($transaction->finished_product);
        }
    }

    public function approvalRevision(string $id, Request $request)
    {
        $transaction = Transaction::find($id);
        if ($request->action == 'revision') {
            $transaction->status = 'revision';
        } else {
            $transaction->status = 'review';
        }
        $transaction->save();
        return redirect(route('member.transaction.show', $id));
    }

    public function review(string $id, Request $request)
    {
        $user = Auth::user();
        $transaction = Transaction::find($id);
        $review = new Review();
        $review->user_id = $user->id;
        $review->transaction_id = $transaction->id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();

        return redirect(route('member.transaction.show', $id));
    }

    public function loadChannel(Request $request) {
        $transaction = json_decode($request->transaction);
        $transaction = TransactionMessage::where('transaction_id', $transaction->id)->first();
        return response()->json(['channel' => $transaction->channel]);
    }

    public function messageSent(Request $request) {
        $user = Auth::user();
        $transactionx = json_decode($request->transaction);
        $message = $request->input('message');
        $imageUrl = '';

        if($message == '' && empty($request->file('attachment'))) {
            return response()->json(['status' => 'Message cannot be empty']);
        } else {
            $transaction = json_decode($transactionx);
            $transactionMessage = TransactionMessage::where('transaction_id', $transaction->id)->first();
            if (!empty($transactionMessage)) {
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    [
                        'cluster' => env('PUSHER_CLUSTER'),
                        'encrypted' => true
                    ]
                );

                if (!empty($request->attachment)) {
                    $pathImage = Storage::put('public/chat', $request->file('attachment'), 'public');
                    $imageUrl = asset(Storage::url($pathImage));
                }

                $response = $pusher->trigger('chatting-app', $transactionMessage->channel, ['message' => $message, 'author' => $user, 'attachment' => $imageUrl, 'channel' => $transactionMessage->channel]);
        
                $chat = new TransactionMessageDetail();
                $chat->transaction_message_id = $transactionMessage->id;
                $chat->user_id = $user->id;
                $chat->attachment = $imageUrl;
                $chat->message = $message;
                $chat->save();  
                return response()->json(['status' => 'Message sent', 'message' => $message, 'attachment' => $imageUrl]);
            }
        }
    }

    public function loadMessages(Request $request) {
        $transaction = json_decode($request->transaction);
        $transactionMessage = TransactionMessage::where('transaction_id', $transaction->id)->with('transaction_message_detail', 'transaction_message_detail.user')->first();
        $transactionMessage->seen_customer = true;
        $transactionMessage->save();
        return response()->json((['messages' => $transactionMessage]));
    }
    
}
