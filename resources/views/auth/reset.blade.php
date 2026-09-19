@extends('layouts.app')
@section('title', 'Reset Password — DAILYDRINK')
@section('content')
<div class="max-w-md mx-auto px-4 py-10"><div class="bg-white rounded-3xl border shadow p-8">
<h1 class="text-xl font-extrabold">Reset Password</h1>
<form method="POST" action="{{ route('password.update') }}" class="mt-4 flex flex-col gap-3">@csrf
<input type="hidden" name="token" value="{{ request('token', $token ?? '') }}">
<input name="email" type="email" required value="{{ request('email') }}" placeholder="Email" class="px-4 py-3 rounded-2xl border text-sm">
<input name="password" type="password" required placeholder="Password baru" class="px-4 py-3 rounded-2xl border text-sm">
<input name="password_confirmation" type="password" required placeholder="Konfirmasi" class="px-4 py-3 rounded-2xl border text-sm">
<button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Reset</button>
</form></div></div>
@endsection
