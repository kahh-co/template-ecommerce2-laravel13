<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — DAILYDRINK')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDF8F3] font-sans">
<div class="flex min-h-screen">
    <aside class="w-60 bg-[#2B1B12] text-cream-100 p-5 hidden md:block">
        <div class="font-extrabold text-lg text-white">☕ DAILYDRINK</div>
        <div class="text-xs opacity-60 mt-1">Admin Panel</div>
        <nav class="mt-6 flex flex-col gap-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="px-3 py-2 rounded-xl hover:bg-white/10">Products</a>
            <a href="{{ route('admin.categories.index') }}" class="px-3 py-2 rounded-xl hover:bg-white/10">Categories</a>
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-2 rounded-xl hover:bg-white/10">Orders</a>
            <a href="{{ route('admin.customers.index') }}" class="px-3 py-2 rounded-xl hover:bg-white/10">Customers</a>
            <a href="{{ route('home') }}" class="px-3 py-2 rounded-xl hover:bg-white/10 mt-4">← Lihat Website</a>
        </nav>
    </aside>
    <div class="flex-1">
        <div class="md:hidden bg-[#2B1B12] text-white px-4 py-2 flex gap-3 text-sm overflow-x-auto">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.categories.index') }}">Categories</a>
            <a href="{{ route('admin.orders.index') }}">Orders</a>
            <a href="{{ route('admin.customers.index') }}">Customers</a>
        </div>
        <div class="p-6 max-w-6xl">
            @if(session('success'))<div class="bg-green-100 border border-green-300 px-4 py-3 rounded-2xl text-sm mb-4">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="bg-red-100 border border-red-300 px-4 py-3 rounded-2xl text-sm mb-4">{{ session('error') }}</div>@endif
            @if($errors->any())<div class="bg-red-50 border px-4 py-3 rounded-2xl text-sm mb-4"><ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
