@extends('layouts.app')
@section('title', 'Cart — DAILYDRINK')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-extrabold">Shopping Cart</h1>
    @if($cart->items->isEmpty())
        <div class="mt-6 bg-white rounded-3xl border p-10 text-center text-stone-500">Keranjang kosong. <a href="{{ route('shop.index') }}" class="text-orange-700 font-bold">Belanja dulu →</a></div>
    @else
    <div class="mt-6 bg-white rounded-3xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-cream-100 text-left"><tr><th class="p-4">Product</th><th class="p-4">Price</th><th class="p-4">Qty</th><th class="p-4">Subtotal</th><th class="p-4"></th></tr></thead>
            <tbody>
            @foreach($cart->items as $item)
            <tr class="border-t">
                <td class="p-4 font-bold">{{ $item->product->name }}</td>
                <td class="p-4">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="p-4">
                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex gap-2">@csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99" class="w-16 px-2 py-1 border rounded-full text-center">
                    <button class="text-xs font-bold text-orange-700">Update</button></form>
                </td>
                <td class="p-4 font-bold">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                <td class="p-4"><form action="{{ route('cart.destroy', $item->id) }}" method="POST">@csrf @method('DELETE')<button class="text-red-600 text-xs font-bold">Remove</button></form></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t bg-cream-50">
            <div class="font-extrabold text-lg">Total: Rp{{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</div>
            <a href="{{ route('checkout.index') }}" class="px-6 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Checkout →</a>
        </div>
    </div>
    @endif
</div>
@endsection
