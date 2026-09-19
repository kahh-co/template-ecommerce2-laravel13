@extends('layouts.app')
@section('title', 'Checkout — DAILYDRINK')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 grid md:grid-cols-2 gap-6">
    <form method="POST" action="{{ route('checkout.store') }}" class="bg-white rounded-3xl border p-6 flex flex-col gap-3">@csrf
        <h1 class="text-xl font-extrabold">Checkout</h1>
        <h2 class="font-bold text-sm mt-2">Customer Information</h2>
        <input name="name" required value="{{ old('name', auth()->user()->name) }}" placeholder="Nama" class="px-4 py-3 rounded-2xl border text-sm">
        <input name="email" required value="{{ old('email', auth()->user()->email) }}" placeholder="Email" class="px-4 py-3 rounded-2xl border text-sm">
        <input name="phone" required value="{{ old('phone', auth()->user()->phone) }}" placeholder="Nomor HP" class="px-4 py-3 rounded-2xl border text-sm">
        <h2 class="font-bold text-sm mt-2">Delivery Information</h2>
        <textarea name="address" required placeholder="Alamat" class="px-4 py-3 rounded-2xl border text-sm">{{ old('address', auth()->user()->address) }}</textarea>
        <div class="grid grid-cols-2 gap-3">
            <input name="city" value="{{ old('city') }}" placeholder="Kota" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="postal_code" value="{{ old('postal_code') }}" placeholder="Kode Pos" class="px-4 py-3 rounded-2xl border text-sm">
        </div>
        <input name="note" value="{{ old('note') }}" placeholder="Catatan (opsional)" class="px-4 py-3 rounded-2xl border text-sm">
        <button class="mt-2 px-6 py-3 rounded-full bg-[#E07B39] text-white font-bold">Pay Now</button>
    </form>
    <div class="bg-white rounded-3xl border p-6 h-fit">
        <h2 class="font-extrabold">Order Summary</h2>
        <div class="mt-3 flex flex-col gap-2 text-sm">
            @foreach($cart->items as $i)
            <div class="flex justify-between"><span>{{ $i->product->name }} × {{ $i->quantity }}</span><b>Rp{{ number_format($i->price * $i->quantity, 0, ',', '.') }}</b></div>
            @endforeach
        </div>
        <div class="border-t mt-3 pt-3 text-sm flex flex-col gap-1">
            <div class="flex justify-between"><span>Subtotal</span><span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span>Shipping</span><span>Rp{{ number_format($shipping, 0, ',', '.') }}</span></div>
            <div class="flex justify-between font-extrabold text-base"><span>Total</span><span>Rp{{ number_format($total, 0, ',', '.') }}</span></div>
        </div>
    </div>
</div>
@endsection
