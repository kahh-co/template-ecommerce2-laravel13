@extends('layouts.admin')
@section('title', 'Orders — Admin')
@section('content')
<h1 class="text-xl font-extrabold">Orders</h1>
<form class="mt-3 flex gap-2 text-sm">
<select name="status" class="px-3 py-2 border rounded-full"><option value="">Semua Status</option>@foreach(['pending','processing','ready','completed','cancelled'] as $s)<option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>@endforeach</select>
<select name="payment" class="px-3 py-2 border rounded-full"><option value="">Semua Payment</option>@foreach(['pending','paid','failed','expired','cancelled'] as $s)<option value="{{ $s }}" @selected(request('payment') === $s)>{{ $s }}</option>@endforeach</select>
<button class="px-4 py-2 rounded-full bg-stone-900 text-white font-bold">Filter</button>
</form>
<div class="mt-4 bg-white rounded-3xl border overflow-hidden">
<table class="w-full text-sm"><thead class="bg-stone-100 text-left"><tr><th class="p-3">Order</th><th class="p-3">Customer</th><th class="p-3">Total</th><th class="p-3">Payment</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead>
<tbody>@foreach($orders as $o)<tr class="border-t"><td class="p-3 font-bold">{{ $o->order_number }}</td><td class="p-3">{{ $o->user->name ?? $o->customer_name }}</td><td class="p-3">Rp{{ number_format($o->total_amount, 0, ',', '.') }}</td><td class="p-3">{{ $o->payment_status }}</td><td class="p-3">{{ $o->order_status }}</td><td class="p-3"><a href="{{ route('admin.orders.show', $o->id) }}" class="text-orange-700 font-bold">Detail</a></td></tr>@endforeach</tbody></table>
</div><div class="mt-3">{{ $orders->links() }}</div>
@endsection
