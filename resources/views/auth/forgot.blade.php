@extends('layouts.app')
@section('title', 'Forgot Password — DAILYDRINK')
@section('content')
<div class="max-w-md mx-auto px-4 py-10"><div class="bg-white rounded-3xl border shadow p-8">
<h1 class="text-xl font-extrabold">Forgot Password</h1>
<form method="POST" action="{{ route('password.email') }}" class="mt-4 flex flex-col gap-3">@csrf
<input name="email" type="email" required placeholder="Email" class="px-4 py-3 rounded-2xl border text-sm">
<button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold">Kirim Link Reset</button>
</form></div></div>
@endsection
