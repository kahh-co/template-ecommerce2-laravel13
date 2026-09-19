@extends('layouts.app')
@section('title', 'Register — DAILYDRINK')
@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    <div class="bg-white rounded-3xl border shadow p-8">
        <h1 class="text-2xl font-extrabold">Join DAILYDRINK ✨</h1>
        <form method="POST" action="{{ route('register') }}" class="mt-6 flex flex-col gap-3">@csrf
            <input name="name" required value="{{ old('name') }}" placeholder="Nama" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="email" type="email" required value="{{ old('email') }}" placeholder="Email" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="phone" value="{{ old('phone') }}" placeholder="Nomor HP" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="password" type="password" required placeholder="Password (min 8)" class="px-4 py-3 rounded-2xl border text-sm">
            <input name="password_confirmation" type="password" required placeholder="Konfirmasi Password" class="px-4 py-3 rounded-2xl border text-sm">
            <button class="px-4 py-3 rounded-full bg-[#E07B39] text-white font-bold">Register</button>
        </form>
        <div class="mt-4 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-orange-700">Login</a></div>
    </div>
</div>
@endsection
