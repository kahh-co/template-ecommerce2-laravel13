@extends('layouts.app')
@section('title', 'DAILYDRINK — Your Daily Drink, Your Daily Mood')
@section('content')
{{-- HERO --}}
<section class="max-w-7xl mx-auto px-4 pt-6 sm:pt-10 grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-center">
    <div>
        <span class="inline-block text-xs font-bold bg-orange-100 text-orange-800 px-3 py-1 rounded-full">FRESH • SIMPLE • GEN Z</span>
        <h1 class="mt-4 text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight text-[#2B1B12]">Your Daily Drink,<br>Your Daily Mood.</h1>
        <p class="mt-4 text-sm sm:text-base text-stone-600">Nikmati kopi dan minuman favoritmu untuk menemani setiap aktivitas.</p>
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('shop.index') }}" class="px-6 py-3 rounded-full bg-[#2B1B12] text-white font-bold hover:bg-[#3E2A1E] text-center">Order Now</a>
            <a href="{{ route('shop.index', ['sort' => 'best']) }}" class="px-6 py-3 rounded-full border border-[#2B1B12] font-bold text-center">Best Seller</a>
        </div>
    </div>
    <div class="rounded-3xl overflow-hidden shadow-xl">
        <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?w=900&q=80&auto=format&fit=crop" alt="Daily Drink" class="w-full h-60 sm:h-80 object-cover">
    </div>
</section>

{{-- CATEGORY --}}
<section class="max-w-7xl mx-auto px-4 mt-12">
    <h2 class="font-extrabold text-xl">Shop by Category</h2>
    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
        @foreach($categories as $c)
        <a href="{{ route('shop.index', ['category' => $c->slug]) }}" class="bg-white rounded-3xl p-5 shadow-sm border hover:shadow-md text-center">
            <div class="text-3xl">🥤</div>
            <div class="mt-2 font-bold">{{ $c->name }}</div>
            <div class="text-xs text-stone-500">{{ $c->products_count }} drinks</div>
        </a>
        @endforeach
    </div>
</section>

{{-- BEST SELLER --}}
<section class="max-w-7xl mx-auto px-4 mt-12">
    <div class="flex items-end justify-between">
        <h2 class="font-extrabold text-xl">Best Seller</h2>
        <a href="{{ route('shop.index') }}" class="text-sm font-bold text-orange-700">Lihat Semua →</a>
    </div>
    <div class="mt-4 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-4">
        @foreach($bestSellers->take(4) as $p)
            @include('components.product-card', ['p' => $p])
        @endforeach
    </div>
</section>

{{-- PROMO --}}
<section class="max-w-7xl mx-auto px-4 mt-12">
    <div class="rounded-3xl bg-[#2B1B12] text-white p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <div class="text-xs font-bold tracking-widest text-orange-300">PROMO SPESIAL</div>
            <div class="text-3xl font-extrabold mt-1">WEEKEND DRINK DEAL</div>
            <div class="mt-1 text-lg">Buy 2 Get 1</div>
        </div>
        <a href="{{ route('shop.index') }}" class="px-6 py-3 rounded-full bg-[#E07B39] font-bold">Shop Now</a>
    </div>
</section>

{{-- BRAND --}}
<section class="max-w-7xl mx-auto px-4 mt-12 text-center">
    <h2 class="font-extrabold text-2xl">Made For Your Everyday.</h2>
    <p class="mt-2 text-stone-600 max-w-2xl mx-auto">DAILYDRINK adalah toko kopi dan minuman kekinian yang cocok menemani aktivitas sehari-hari — dari nongkrong, kerja, sampai begadang tugas.</p>
</section>

{{-- LATEST --}}
<section class="max-w-7xl mx-auto px-4 mt-12">
    <h2 class="font-extrabold text-xl">Terbaru</h2>
    <div class="mt-4 grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-4">
        @foreach($latest as $p)
            @include('components.product-card', ['p' => $p])
        @endforeach
    </div>
</section>
@endsection
