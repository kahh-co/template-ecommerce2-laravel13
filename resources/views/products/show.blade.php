@extends('layouts.app')
@section('title', $product->name.' — DAILYDRINK')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 sm:py-8 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
    <div class="rounded-3xl overflow-hidden shadow"><img src="{{ $product->image_url }}" class="w-full h-64 sm:h-80 md:h-[420px] object-cover" alt="{{ $product->name }}"></div>
    <div>
        <div class="text-xs font-bold text-orange-700 uppercase">{{ $product->category->name }}</div>
        <h1 class="text-3xl font-extrabold mt-1">{{ $product->name }}</h1>
        <div class="text-2xl font-extrabold mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
        <p class="mt-3 text-stone-600">{{ $product->description }}</p>
        <div class="mt-2 text-sm">Stok: <b>{{ $product->stock }}</b></div>
        @auth
        <form action="{{ route('cart.store') }}" method="POST" class="mt-5 flex gap-3 items-center">@csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 px-3 py-2 rounded-full border">
            <button class="px-6 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Add to Cart</button>
        </form>
        <form action="{{ route('cart.store') }}" method="POST" class="mt-2">@csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}"><input type="hidden" name="quantity" value="1">
            <button formaction="{{ route('cart.store') }}" onclick="this.form.submit();setTimeout(()=>location.href='{{ route('checkout.index') }}',300);return false;" class="px-6 py-3 rounded-full bg-[#E07B39] text-white font-bold w-full md:w-auto">Buy Now</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="mt-5 inline-block px-6 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Login untuk Beli</a>
        @endauth
    </div>
</div>
@if($related->count())
<div class="max-w-6xl mx-auto px-4 pb-8">
    <h2 class="font-extrabold text-lg">Kamu Mungkin Suka</h2>
    <div class="mt-3 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-4">@foreach($related as $p)@include('components.product-card', ['p' => $p])@endforeach</div>
</div>
@endif
@endsection
