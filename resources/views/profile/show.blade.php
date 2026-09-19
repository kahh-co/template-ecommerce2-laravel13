@extends('layouts.app')
@section('title', 'Profile — DAILYDRINK')
@section('content')
<div class="max-w-2xl mx-auto px-4 py-8 grid gap-4">
    <form method="POST" action="{{ route('profile.update') }}" class="bg-white rounded-3xl border p-6 flex flex-col gap-3">@csrf @method('PATCH')
        <h1 class="text-xl font-extrabold">Profile</h1>
        <label class="text-sm">Nama<input name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full px-4 py-3 rounded-2xl border text-sm"></label>
        <label class="text-sm">Email (tidak bisa diubah)<input value="{{ $user->email }}" disabled class="mt-1 w-full px-4 py-3 rounded-2xl border bg-stone-100 text-sm"></label>
        <label class="text-sm">Nomor HP<input name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 w-full px-4 py-3 rounded-2xl border text-sm"></label>
        <label class="text-sm">Alamat<textarea name="address" class="mt-1 w-full px-4 py-3 rounded-2xl border text-sm">{{ old('address', $user->address) }}</textarea></label>
        <button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold text-sm">Simpan</button>
    </form>
    <form method="POST" action="{{ route('profile.password') }}" class="bg-white rounded-3xl border p-6 flex flex-col gap-3">@csrf @method('PATCH')
        <h2 class="font-extrabold">Ubah Password</h2>
        <input name="current_password" type="password" placeholder="Password saat ini" class="px-4 py-3 rounded-2xl border text-sm">
        <input name="password" type="password" placeholder="Password baru" class="px-4 py-3 rounded-2xl border text-sm">
        <input name="password_confirmation" type="password" placeholder="Konfirmasi" class="px-4 py-3 rounded-2xl border text-sm">
        <button class="px-4 py-3 rounded-full border font-bold text-sm">Update Password</button>
    </form>
</div>
@endsection
