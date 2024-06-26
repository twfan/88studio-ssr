<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailCompleteNotification;
use App\Jobs\SendEmailWIPNotification;
use App\Models\Transaction;
use App\Models\TransactionMessage;
use App\Models\TransactionMessageDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function vtubersIndex()
    {
        $transactions = Transaction::where('transaction_type',Transaction::DIRECT)->where('status', Transaction::COMPLETED)->orderBy('created_at', 'desc')->get();
        return view('admin.vtubers.index', compact('transactions'));
    }

    public function vtubersShow($transaction)
    {
        $transaction = Transaction::where('id', $transaction)->with('transactionDetails')->first();
        return view('admin.vtubers.show', compact('transaction'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::where('id', $id)->with(['transactionDetails', 'transactionDetails.product'])->first();
        return view('admin.transactions.edit', compact('transaction'));
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

    public function uploadProduct(string $id, Request $request) 
    {
        $transaction = Transaction::find($id);
        if($transaction->finished_product) {
            $this->deleteFile($transaction->finished_product);
        }
        $pathProduct = Storage::put('public/transactions/finished-product', $request->file('finished_product'), 'public');
        $productUrl = asset(Storage::url($pathProduct));
        $transaction->finished_product = $productUrl;
        $transaction->status = 'finished';
        $transaction->save();
        return redirect(route('admin.transactions.edit', $id));
    }

    function deleteFile(string $url)
    {
        // Extract the path from the URL
        $path = parse_url($url, PHP_URL_PATH);

        // Get the file name from the path
        $fileName = basename($path);

        // Specify the storage disk (you can change it based on your configuration)
        $disk = 'public';

        // Delete the file
        if (Storage::disk($disk)->exists($fileName)) {
            Storage::disk($disk)->delete($fileName);
        }
    }
    
    public function downloadProduct(Request $request) 
    {
        $id = $request->transactionIdFinal;
        $transaction = Transaction::find($id);
        return Storage::download($transaction->finished_product);
    }

    public function progressTransaction(Request $request)
    {
        try {
            DB::beginTransaction();
       
            $transaction = Transaction::find($request->id);
            $transaction->status = $request->status;

            if ($request->status === 'wip') {
                $transactionMessage = TransactionMessage::firstOrCreate([
                    'transaction_id' => $transaction->id, 
                    'channel' => "chat/" . $transaction->id . "/" . $transaction->user_id
                ]);
            }

            $transaction->save();
            
            SendEmailWIPNotification::dispatch($transaction);

            DB::commit();

            return redirect(route('admin.dashboard'));

        } catch (Exception $e) {
            DB::rollBack();
        }

    }

    public function loadChannel(Request $request) {
        $transaction = $request->transaction;
        $transaction = TransactionMessage::where('transaction_id', $transaction['id'])->first();
        return response()->json(['channel' => $transaction->channel]);
    }

    public function messageSent(Request $request) {
        $user = Auth::user();
        $transaction = json_decode($request->transaction);
        $message = $request->input('message');
        $imageUrl = '';

        if($message == '' && empty($request->file('attachment'))) {
            return response()->json(['status' => 'Message cannot be empty']);
        } else {
            $transactionMessage = TransactionMessage::where('transaction_id', $transaction->id)->first();
            $transactionMessage->save();
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
        $transactionMessage = TransactionMessage::where('transaction_id', $request->transaction['id'])->with('transaction_message_detail','transaction_message_detail.user')->first();
        $transactionMessage->save();
        return response()->json((['messages' => $transactionMessage]));
    }

    public function markAsComplete(Request $request) {
        $transactionId = $request->transactionId;
        $file = $request->file('file');
        $verifiedMedia = $request->file('verifiedMedia');
        $textArea = $request->textArea;
        

        if (!empty($file)) {
            $transaction = Transaction::find($transactionId);
            $path = $file->store('private-files');
            if (!empty($verifiedMedia)) {
                $pathVerifiedMedia = Storage::put('public/verified-media', $verifiedMedia, 'public');
                $fullPathVerifiedMedia = asset(Storage::url($pathVerifiedMedia));
                $transaction->verified_media = $fullPathVerifiedMedia; 
            }
            $transaction->finished_product = $path;
            $transaction->notes_finale = $textArea;
            $transaction->status = Transaction::COMPLETED;
            $transaction->save();

            SendEmailCompleteNotification::dispatch($transaction);

            Storage::setVisibility($path, 'private');

            return response()->json(['messages' => 'File upload success.']);
        } else {
            return response()->json(['messages' => 'File cannot be null']);
        }
    }

    public function downloadFile(Request $request) {
        $transaction = Transaction::find($request->transactionIdFinal);
        if (!empty($transaction)) {
            return Storage::download($transaction->finished_product);
        } else {
            return response()->json(['messages' => 'Transaction not found!']);
        }
    }



    public function moveToWaitlist(Request $request) {
        $transaction = Transaction::find($request->transactionId);
        if (!empty($transaction)) {
            $transaction->status = Transaction::WAITLIST;
            $transaction->save();
            return response()->json(['messages' => 'Transaction moved to waitlist']);
        } else {
            return response()->json(['messages' => 'Transaction not found!']);
        }
    }
}
