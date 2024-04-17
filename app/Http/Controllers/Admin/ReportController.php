<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ReportCategories;
use App\Models\Transaction;
use App\Models\TransactionDetails;
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

        $categories = Category::all();

        // Create an array to hold monthly totals initialized with zeros
        $monthlyTotals = [];
        $monthlyTotalsRepeatOrder = [];
        $monthlyTotalNewOrder = [];
        $totalBought = [];
        $categoryNameOrdered = [];

        // Fetch monthly totals from the database
        $monthlyData = Transaction::select(
                DB::raw('SUM(grand_total) as total'),
                DB::raw('MONTH(created_at) as month')
            )->whereIn('transaction_type', [Transaction::DIRECT, Transaction::PROPOSAL])
            ->whereIn('status', [Transaction::READY, Transaction::WIP, Transaction::COMPLETED])
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Populate the monthly totals array with fetched data or zeros if no data found
        for ($month = 1; $month <= 12; $month++) {
            array_push($monthlyTotals, $monthlyData->get($month, 0));
        }
        
        
        $monthlyDataRepeatOrder = Transaction::select(
                DB::raw('COUNT(*) as totalRepeat'),
                DB::raw('MONTH(created_at) as month')
            )->whereIn('transaction_type', [Transaction::DIRECT, Transaction::PROPOSAL])
            ->whereIn('status', [Transaction::READY, Transaction::WIP, Transaction::COMPLETED])
            ->where('repeat_order', 1)
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('totalRepeat', 'month');

        // Populate the monthly totals array with fetched data or zeros if no data found
        for ($month = 1; $month <= 12; $month++) {
            array_push($monthlyTotalsRepeatOrder, $monthlyDataRepeatOrder->get($month, 0));
        }
        
        $monthlyDataNewOrder = Transaction::select(
                DB::raw('COUNT(*) as totalRepeat'),
                DB::raw('MONTH(created_at) as month')
            )->whereIn('transaction_type', [Transaction::DIRECT, Transaction::PROPOSAL])
            ->whereIn('status', [Transaction::READY, Transaction::WIP, Transaction::COMPLETED])
            ->where('repeat_order', 0)
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('totalRepeat', 'month');

        // Populate the monthly totals array with fetched data or zeros if no data found
        for ($month = 1; $month <= 12; $month++) {
            array_push($monthlyTotalNewOrder, $monthlyDataNewOrder->get($month, 0));
        }

        foreach($categories as $category) {
            $categoryBought = ReportCategories::select(
                DB::raw('COUNT(*) as totalBought')
            )->where('category_id', $category->id)
            ->whereYear('created_at', $currentYear)
            ->pluck('totalBought');

            if (count($categoryBought) > 0) {
                array_push($categoryNameOrdered, $category->name);
                array_push($totalBought, $categoryBought[0]);
            }
        }


        return view('admin.reports.index', compact('monthlyTotals', 'monthlyTotalsRepeatOrder', 'monthlyTotalNewOrder', 'categoryNameOrdered', 'totalBought'));
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
