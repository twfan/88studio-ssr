<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status='new')
    {
        $transactions = Transaction::with(['user', 'proposal', 'transactionDetails', 'transactionDetails.product'])->get();
        $newTransactions = $transactions->where('status', 'new');
        $readyTransactions = $transactions->where('status', 'ready');
        $wipTransactions = $transactions->where('status', 'wip');
        $waitlistTransactions = $transactions->where('status', 'waitlist');
        $clientToDoTransactions = $transactions->where('status', 'client_to_do');
        $pausedTransactions = $transactions->where('status', 'paused');
        $completedTransactions = $transactions->where('status', 'completed');
        $archivedTransactions = $transactions->where('status', 'archived');

        $dataTransactions = $transactions->where('status', $status)->sortByDesc('id');

        return view('dashboard')->with(
            [
                'transactions' => $transactions,
                'newTransactions' => $newTransactions,
                'readyTransactions' => $readyTransactions,
                'wipTransactions' => $wipTransactions,
                'waitlistTransactions' => $waitlistTransactions,
                'clientToDoTransactions' => $clientToDoTransactions,
                'pausedTransactions' => $pausedTransactions,
                'completedTransactions' => $completedTransactions,
                'archivedTransactions' => $archivedTransactions,
                'dataTransactions' => $dataTransactions
            ]
        );
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
}
