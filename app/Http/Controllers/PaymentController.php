<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
  public function retrieve($start,$end){

    $startDate = $start ?: now()->startOfDay()->toDateString();
    $endDate = $end ?: now()->endOfDay()->toDateString();

    // Get daily revenue within the date range
    $dailyRevenue = Payment::whereBetween('created_at', [$startDate, $endDate])
        ->groupBy(DB::raw("DATE(created_at)"))
        ->selectRaw("DATE(created_at) as date, SUM(amount) as revenue")
        ->get();

    // Calculate total revenue
    $totalRevenue = $dailyRevenue->sum('revenue');

    // Get weekly and monthly revenue
    $weeklyRevenue = Payment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('amount');

    $monthlyRevenue = Payment::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
        ->sum('amount');

    // Get revenue by payment method
 /*    $paymentMethods = Payment::whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('payment_method')
        ->selectRaw("payment_method as method, SUM(amount) as amount")
        ->get(); */

    return response()->json([
        'total' => $totalRevenue,
        'daily' => $dailyRevenue->last()->revenue ?? 0, // Latest daily revenue
        'weekly' => $weeklyRevenue,
        'monthly' => $monthlyRevenue,
        'chartData' => $dailyRevenue,
        //'paymentMethods' => $paymentMethods
    ]);
   }
}
