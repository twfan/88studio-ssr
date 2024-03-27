<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');

        // Create an array to hold monthly totals initialized with zeros
        $monthlyTotals = [];

        // Fetch monthly totals from the database
        $monthlyData = Transaction::select(
                DB::raw('SUM(grand_total) as total'),
                DB::raw('MONTH(created_at) as month')
            )->whereIn('transaction_type', [Transaction::DIRECT, Transaction::PROPOSAL])
            ->where('status', Transaction::COMPLETED)
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Populate the monthly totals array with fetched data or zeros if no data found
        for ($month = 1; $month <= 12; $month++) {
            array_push($monthlyTotals, $monthlyData->get($month, 0));
        }
        // dd($monthlyTotals);
        return view('admin.reports.index', compact('monthlyTotals'));
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
