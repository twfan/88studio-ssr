<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function approvalPayment(string $id, Request $request)
    {
        $transaction = Transaction::find($id);
        if ($request->action == 'approve') {
            $transaction->status = 'work_in_progress';
        } else {
            $transaction->status = 'payment_declined';
        }
        $transaction->save();
        return redirect(route('admin.transactions.edit', $id));
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
    
    public function downloadProduct(string $id) 
    {
        $transaction = Transaction::find($id);
        $filePath = str_replace(url('storage'), 'public', $transaction->finished_product);
        return response()->download(storage_path("app/$filePath"));
    }
}
