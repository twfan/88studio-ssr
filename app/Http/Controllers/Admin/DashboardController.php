<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailProposalNotification;
use App\Mail\ProposalSend;
use App\Models\Proposal;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status='new')
    {
        $transactions = Transaction::where('transaction_type', 'proposal')->with(['user', 'proposal', 'proposal.discount', 'transactionDetails', 'transactionDetails.product','transactionMessages'])->orderBy('updated_at', 'desc')->get();
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
                $transaction = Transaction::where('id', $request->transactionId)->with(['user', 'proposal', 'proposal.discount'])->first();
                if ($transaction->proposal->discount) {
                    $user = $transaction->user;
                    $discount = $transaction->proposal->discount;
                    $user->discounts()->attach($discount->id);
                }
                $transaction->status = Transaction::CLIENT_TO_DO;
                $transaction->sub_total = $request->subtotal;
                $transaction->discount = $request->discount ? $request->discount : 0;
                $transaction->grand_total = $request->grandtotal;
                $transaction->proposal_project_subtotal = $request->subtotal;
                $transaction->save();
            }


            $transaction = Transaction::where('id', $request->transactionId)->with(['transactionDetails', 'transactionDetails.product', 'transactionDetails.product.category'])->first();
            $user = $transaction->user;
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
                $items[] = InvoiceItem::make($transactionDetail['product']['id_product'])
                    ->pricePerUnit($transactionDetail->price);
            }
            
            $notes = [
                'you need to make a payment using paypal before the due date',
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
                ->totalAmount($request->subtotal)
                // You can additionally save generated invoice to configured disk
                ->save('public');
            
            $link = $invoice->url();
            // Then send email to party with link
            $transaction->invoice_url = $link;
            $transaction->save();

            dd("cok2");
            
    
            DB::commit();
            
            SendEmailProposalNotification::dispatch($transaction);
            return redirect(route('admin.dashboard'));

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function markAsComplete(Request $request) {
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
