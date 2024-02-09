<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProposalSend;
use App\Models\Proposal;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        $dataTransactions = [];
        switch ($status) {
            case 'new':
                $dataTransactions = $newTransactions;
                break;
            case 'ready':
                $dataTransactions = $readyTransactions;
                break;
            case 'wip':
                $dataTransactions = $wipTransactions;
                break;
            case 'waitlist':
                $dataTransactions = $waitlistTransactions;
                break;
            case 'client_to_do':
                $dataTransactions = $clientToDoTransactions;
                break;
            case 'paused':
                $dataTransactions = $pausedTransactions;
                break;
            case 'completed':
                $dataTransactions = $completedTransactions;
                break;
            case 'archived':
                $dataTransactions = $archivedTransactions;
                break;
            default:
                $dataTransactions = $transactions;
                break;
            }

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

    public function sendProposal(Request $request) {
        

        try {
            DB::beginTransaction();

            if (!empty($request->proposalId)) {
                $proposal = Proposal::find($request->proposalId);
                $proposal->scope = $request->scope;
                $proposal->estimated_start = $request->estimated_start;
                $proposal->guaranteed_delivery = $request->guaranteed_delivery;
                $proposal->project_subtotal = $request->subtotal;
                $proposal->save();
            }

            if (!empty($request->transactionId)) {
                $transaction = Transaction::where('id', $request->transactionId)->with(['user', 'proposal'])->first();
                $transaction->status = 'ready';
                $transaction->save();
            }

            $tes = Mail::to($transaction->user->email)->send(new ProposalSend($transaction));

            DB::commit();

            return redirect(route('admin.dashboard'));

        } catch (Exception $e) {
            DB::rollBack();
        }
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
