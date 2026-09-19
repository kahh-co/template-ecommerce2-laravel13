@extends('layouts.admin')
@section('title', 'Dashboard — DAILYDRINK')
@section('content')
<h1 class="text-2xl font-extrabold">Dashboard</h1>
<div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-3">
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Total Products</div><div class="text-2xl font-extrabold">{{ $totalProducts }}</div></div>
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Total Customers</div><div class="text-2xl font-extrabold">{{ $totalCustomers }}</div></div>
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Total Orders</div><div class="text-2xl font-extrabold">{{ $totalOrders }}</div></div>
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Total Sales</div><div class="text-2xl font-extrabold">Rp{{ number_format($totalSales, 0, ',', '.') }}</div></div>
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Pending Orders</div><div class="text-2xl font-extrabold">{{ $pendingOrders }}</div></div>
    <div class="bg-white rounded-3xl border p-5"><div class="text-xs text-stone-500">Completed</div><div class="text-2xl font-extrabold">{{ $completedOrders }}</div></div>
</div>
<div class="mt-6 bg-white rounded-3xl border p-5">
    <h2 class="font-bold">Recent Orders</h2>
    <table class="w-full text-sm mt-3">
        @forelse($recentOrders as $o)
        <tr class="border-t"><td class="py-2 font-bold"><a href="{{ route('admin.orders.show', $o->id) }}" class="text-orange-700">{{ $o->order_number }}</a></td><td>{{ $o->user->name ?? '-' }}</td><td class="text-right">Rp{{ number_format($o->total_amount, 0, ',', '.') }}</td><td class="text-right">{{ $o->payment_status }}/{{ $o->order_status }}</td></tr>
        @empty<tr><td class="py-4 text-stone-500">Belum ada order.</td></tr>@endforelse
    </table>
</div>
@endsection
