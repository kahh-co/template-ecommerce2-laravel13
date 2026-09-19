@extends('layouts.app')
@section('title', 'Login — DAILYDRINK')
@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    <div class="bg-white rounded-3xl border shadow p-8">
        <h1 class="text-2xl font-extrabold">Welcome Back 👋</h1>
        <p class="text-sm text-stone-500 mt-1">Login untuk checkout minuman favoritmu.</p>
        <form method="POST" action="{{ route('login') }}" class="mt-6 flex flex-col gap-3">@csrf
            <input name="email" type="email" required value="{{ old('email') }}" placeholder="Email" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="password" type="password" required placeholder="Password" class="px-4 py-3 rounded-2xl border text-sm">
            <label class="text-sm flex items-center gap-2"><input type="checkbox" name="remember"> Ingat saya</label>
            <button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Login</button>
        </form>
        <div class="mt-4 text-sm flex justify-between">
            <a href="{{ route('register') }}" class="font-bold text-orange-700">Register</a>
            <a href="{{ route('password.request') }}" class="text-stone-500">Forgot password?</a>
        </div>
    </div>
</div>
@endsection
