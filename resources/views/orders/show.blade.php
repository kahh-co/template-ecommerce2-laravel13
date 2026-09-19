@extends('layouts.app')
@section('title', 'Order '.$order->order_number)
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-3xl border p-6">
        <h1 class="text-xl font-extrabold">{{ $order->order_number }}</h1>
        <div class="text-sm text-stone-500">{{ $order->created_at->format('d M Y H:i') }}</div>
        <div class="mt-3 flex gap-2 text-xs font-bold">
            <span class="px-3 py-1 rounded-full bg-stone-100">Payment: {{ $order->payment_status }}</span>
            <span class="px-3 py-1 rounded-full bg-stone-100">Order: {{ $order->order_status }}</span>
        </div>
        <div class="mt-4 text-sm">
            <div><b>{{ $order->customer_name }}</b> • {{ $order->customer_phone }}</div>
            <div class="text-stone-600">{{ $order->address }} {{ $order->city }} {{ $order->postal_code }}</div>
            @if($order->note)<div class="text-stone-500">Note: {{ $order->note }}</div>@endif
        </div>
        <table class="w-full text-sm mt-4">
            @foreach($order->items as $i)
            <tr class="border-t"><td class="py-2">{{ $i->product_name }} × {{ $i->quantity }}</td><td class="text-right font-bold">Rp{{ number_format($i->subtotal, 0, ',', '.') }}</td></tr>
            @endforeach
        </table>
        <div class="border-t mt-2 pt-2 text-sm flex flex-col gap-1">
            <div class="flex justify-between"><span>Subtotal</span><span>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Shipping</span><span>Rp{{ number_format($order->shipping, 0, ',', '.') }}</span></div>
            <div class="flex justify-between font-extrabold"><span>Total</span><span>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></div>
        </div>
        @if($order->payment_status === 'pending')
        <a href="{{ route('checkout.pay', $order->order_number) }}" class="mt-4 inline-block px-6 py-3 rounded-full bg-[#E07B39] text-white font-bold">Bayar Sekarang</a>
        @endif
    </div>
</div>
@endsection
