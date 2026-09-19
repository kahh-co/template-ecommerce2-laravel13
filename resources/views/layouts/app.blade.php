<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DAILYDRINK — Your Daily Drink, Your Daily Mood')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDF8F3] text-stone-900 antialiased">
    <header class="sticky top-0 z-40 bg-[#2B1B12] text-cream-50 shadow">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-extrabold text-xl tracking-tight">
                <span class="w-9 h-9 rounded-2xl bg-[#E07B39] grid place-items-center text-white text-lg">☕</span>
                DAILYDRINK
            </a>
            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-orange-300">Home</a>
                <a href="{{ route('shop.index') }}" class="hover:text-orange-300">Shop</a>
                @foreach(\App\Models\Category::orderBy('name')->take(4)->get() as $c)
                    <a href="{{ route('shop.index', ['category' => $c->slug]) }}" class="hover:text-orange-300 hidden lg:inline">{{ $c->name }}</a>
                @endforeach
            </div>
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('cart.index') }}" class="px-3 py-2 rounded-full bg-white/10 hover:bg-white/20 text-sm font-semibold">🛒 Cart</a>
                    <a href="{{ route('orders.index') }}" class="hidden sm:inline px-3 py-2 rounded-full bg-white/10 hover:bg-white/20 text-sm font-semibold">Orders</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-full bg-[#E07B39] text-white text-sm font-semibold">Admin</a>
                    @endif
                    <a href="{{ route('profile.show') }}" class="w-9 h-9 rounded-full bg-orange-200 text-[#2B1B12] grid place-items-center font-bold">{{ substr(auth()->user()->name, 0, 1) }}</a>
                    <form action="{{ route('logout') }}" method="POST">@csrf<button class="text-xs opacity-70 hover:opacity-100 ml-1">Logout</button></form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold px-4 py-2 rounded-full bg-[#E07B39] text-white">Register</a>
                @endauth
                <a href="{{ route('shop.index') }}" class="md:hidden px-3 py-2 text-sm">☰</a>
            </div>
        </nav>
        <div class="md:hidden border-t border-white/10 px-4 py-2 flex gap-4 text-sm overflow-x-auto">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}">Shop</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <a href="{{ route('orders.index') }}">Orders</a>
        </div>
    </header>

    <main class="min-h-[70vh]">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-green-100 border border-green-300 text-green-900 px-4 py-3 rounded-2xl text-sm">{{ session('success') }}</div></div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-red-100 border border-red-300 text-red-900 px-4 py-3 rounded-2xl text-sm">{{ session('error') }}</div></div>
        @endif
        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 mt-4"><div class="bg-red-50 border border-red-200 px-4 py-3 rounded-2xl text-sm"><ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-16 bg-[#2B1B12] text-cream-100">
        <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-8 text-sm">
            <div>
                <div class="font-extrabold text-lg text-white">DAILYDRINK</div>
                <p class="mt-2 opacity-80">Your Daily Drink, Your Daily Mood. Kopi & minuman kekinian untuk Gen Z.</p>
            </div>
            <div>
                <div class="font-bold text-white">Shop</div>
                <div class="mt-2 flex flex-col gap-1 opacity-80">
                    <a href="{{ route('shop.index') }}">All Products</a>
                    <a href="{{ route('shop.index', ['sort' => 'best']) }}">Best Seller</a>
                    <a href="{{ route('orders.index') }}">Order History</a>
                </div>
            </div>
            <div>
                <div class="font-bold text-white">Demo Accounts</div>
                <p class="mt-2 opacity-80">Admin: admin@dailydrink.id / password<br>Customer: demo@dailydrink.id / password<br><span class="text-xs">Payment: mode MOCK (tombol simulasi di halaman bayar)</span></p>
            </div>
        </div>
    </footer>
</body>
</html>
