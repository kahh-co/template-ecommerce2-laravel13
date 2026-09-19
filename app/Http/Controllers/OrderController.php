<?php

namespace App\Http\Controllers;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(string $orderNumber)
    {
        $order = auth()->user()->orders()->with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
