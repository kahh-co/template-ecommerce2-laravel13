@extends('layouts.admin')
@section('title', 'Order '.$order->order_number)
@section('content')
<h1 class="text-xl font-extrabold">{{ $order->order_number }}</h1>
<div class="mt-4 bg-white rounded-3xl border p-6 text-sm grid gap-2">
<div><b>{{ $order->customer_name }}</b> • {{ $order->customer_email }} • {{ $order->customer_phone }}</div>
<div class="text-stone-600">{{ $order->address }} {{ $order->city }} {{ $order->postal_code }}</div>
<table class="w-full mt-2">@foreach($order->items as $i)<tr class="border-t"><td class="py-2">{{ $i->product_name }} × {{ $i->quantity }}</td><td class="text-right font-bold">Rp{{ number_format($i->subtotal, 0, ',', '.') }}</td></tr>@endforeach</table>
<div class="font-extrabold">Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }} • Payment: {{ $order->payment_status }}</div>
<form method="POST" action="{{ route('admin.orders.update', $order->id) }}" class="mt-3 flex gap-2 items-center">@csrf @method('PATCH')
<select name="order_status" class="px-3 py-2 border rounded-full text-sm">@foreach(['pending','processing','ready','completed','cancelled'] as $s)<option value="{{ $s }}" @selected($order->order_status === $s)>{{ $s }}</option>@endforeach</select>
<button class="px-4 py-2 rounded-full bg-[#2B1B12] text-white font-bold text-sm">Update Status</button>
</form>
</div>
@endsection
