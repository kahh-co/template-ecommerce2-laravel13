@extends('layouts.app')
@section('title', 'Cart — DAILYDRINK')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-6 sm:py-8">
    <h1 class="text-xl sm:text-2xl font-extrabold">Shopping Cart</h1>
    @if($cart->items->isEmpty())
        <div class="mt-6 bg-white rounded-3xl border p-10 text-center text-stone-500">Keranjang kosong. <a href="{{ route('shop.index') }}" class="text-orange-700 font-bold">Belanja dulu →</a></div>
    @else
    {{-- DESKTOP: table --}}
    <div class="mt-6 bg-white rounded-3xl border overflow-hidden hidden md:block">
        <table class="w-full text-sm">
            <thead class="bg-cream-100 text-left"><tr><th class="p-4">Product</th><th class="p-4">Price</th><th class="p-4">Qty</th><th class="p-4">Subtotal</th><th class="p-4"></th></tr></thead>
            <tbody>
            @foreach($cart->items as $item)
            <tr class="border-t">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $item->product->image_url ?? '' }}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-xl object-cover bg-stone-100 shrink-0">
                        <span class="font-bold">{{ $item->product->name }}</span>
                    </div>
                </td>
                <td class="p-4 whitespace-nowrap">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="p-4">
                    <div class="flex items-center gap-1">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">@csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                            <button class="w-8 h-8 rounded-full border font-bold disabled:opacity-30" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                        </form>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">@csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ min(99, $item->product->stock ?? 99) }}" onchange="this.form.submit()" class="w-14 px-1 py-1 border rounded-xl text-center text-sm">
                        </form>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">@csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button class="w-8 h-8 rounded-full border font-bold disabled:opacity-30" {{ ($item->product->stock ?? 99) <= $item->quantity ? 'disabled' : '' }}>+</button>
                        </form>
                    </div>
                </td>
                <td class="p-4 font-bold whitespace-nowrap">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
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

    {{-- MOBILE: card list --}}
    <div class="mt-4 flex flex-col gap-3 md:hidden">
        @foreach($cart->items as $item)
        <div class="bg-white rounded-2xl border p-3 flex gap-3">
            <img src="{{ $item->product->image_url ?? '' }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover bg-stone-100 shrink-0">
            <div class="flex-1 min-w-0">
                <div class="font-bold text-sm leading-snug line-clamp-2">{{ $item->product->name }}</div>
                <div class="text-xs text-stone-500 mt-0.5">Rp{{ number_format($item->price, 0, ',', '.') }} /pcs</div>
                <div class="mt-2 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-1">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">@csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                            <button class="w-8 h-8 rounded-full border font-bold text-sm disabled:opacity-30" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                        </form>
                        <span class="w-8 text-center text-sm font-bold">{{ $item->quantity }}</span>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">@csrf @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button class="w-8 h-8 rounded-full bg-[#2B1B12] text-white font-bold text-sm disabled:opacity-30" {{ ($item->product->stock ?? 99) <= $item->quantity ? 'disabled' : '' }}>+</button>
                        </form>
                    </div>
                    <div class="font-extrabold text-sm whitespace-nowrap">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                </div>
                <div class="mt-1 flex justify-end">
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">@csrf @method('DELETE')<button class="text-red-600 text-[11px] font-bold">Remove</button></form>
                </div>
            </div>
        </div>
        @endforeach
        <div class="bg-white rounded-2xl border p-4 flex items-center justify-between gap-3 sticky bottom-3 shadow-lg">
            <div>
                <div class="text-[11px] text-stone-500 font-semibold">TOTAL</div>
                <div class="font-extrabold">Rp{{ number_format($cart->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</div>
            </div>
            <a href="{{ route('checkout.index') }}" class="px-6 py-3 rounded-full bg-[#2B1B12] text-white font-bold text-sm">Checkout →</a>
        </div>
    </div>
    @endif
</div>
@endsection
