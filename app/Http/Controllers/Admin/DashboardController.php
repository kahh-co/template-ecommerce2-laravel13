<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalOrders' => Order::count(),
            'totalSales' => (int) Order::where('payment_status', 'paid')->sum('total_amount'),
            'pendingOrders' => Order::where('order_status', 'pending')->count(),
            'completedOrders' => Order::where('order_status', 'completed')->count(),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
        ]);
    }
}
