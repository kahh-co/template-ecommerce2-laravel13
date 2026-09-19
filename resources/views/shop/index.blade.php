@extends('layouts.app')
@section('title', 'Shop — DAILYDRINK')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-extrabold">Shop All Drinks</h1>
    <form method="GET" class="mt-4 bg-white rounded-3xl border p-4 grid md:grid-cols-5 gap-3">
        <input name="q" value="{{ request('q') }}" placeholder="Search your favorite drink..." class="md:col-span-2 px-4 py-2 rounded-full border text-sm">
        <select name="category" class="px-4 py-2 rounded-full border text-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories as $c)<option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->name }}</option>@endforeach
        </select>
        <select name="sort" class="px-4 py-2 rounded-full border text-sm">
            <option value="">Terbaru</option>
            <option value="best" @selected(request('sort') === 'best')>Best Seller</option>
            <option value="termurah" @selected(request('sort') === 'termurah')>Termurah</option>
            <option value="termahal" @selected(request('sort') === 'termahal')>Termahal</option>
        </select>
        <button class="px-4 py-2 rounded-full bg-[#2B1B12] text-white text-sm font-bold">Filter</button>
    </form>
    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($products as $p)
            @include('components.product-card', ['p' => $p])
        @empty
            <div class="col-span-full text-center text-stone-500 py-10">Tidak ada produk ditemukan.</div>
        @endforelse
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
</div>
@endsection
