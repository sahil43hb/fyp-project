<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class DashboardController extends Controller
{
    public function index()
    {
        $monthlyTotals = [];
        $monthLabels = [];
        $monthlyUserCounts = [];
        $currentMonth = Carbon::now()->startOfMonth();
        for ($i = 0; $i < 6; $i++) {
            $startDate = $currentMonth->copy()->startOfMonth();
            $endDate = $currentMonth->copy()->endOfMonth();
            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
            $userCount = User::whereBetween('created_at', [$startDate, $endDate])->count();
            $totalAmount = $orders->sum('total');
            $monthlyUserCounts[] = $userCount;
            $monthlyTotals[] = $totalAmount;
            $monthLabels[] = $currentMonth->format('M Y');
            $currentMonth->subMonth();
        }
        $monthlyTotals = array_reverse($monthlyTotals);
        $monthLabels = array_reverse($monthLabels);
        $monthlyUserCounts = array_reverse($monthlyUserCounts);
        $orders = Order::whereHas('payment', function ($query) {
            $query->where('payment_status', 'paid');
        })->get();
        $users = User::where('role', 'user')->count();
        $login_activities = LoginActivity::with('user')
            ->latest()
            ->take(10)
            ->get();
        return view('admin.index', compact('orders', 'users', 'login_activities', 'monthlyTotals', 'monthLabels', 'monthlyUserCounts'));
    }

    public function generateReport()
    {
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        // Pass the order data to the invoice view
        $invoiceData = [
            'orders' => $orders,
        ];
        // Generate PDF using the invoice data
        $pdf = PDF::loadView('pdf.report', $invoiceData);
        return $pdf->stream('report.pdf');
    }
}
