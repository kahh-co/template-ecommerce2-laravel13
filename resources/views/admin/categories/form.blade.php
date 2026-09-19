@extends('layouts.admin')
@section('title', ($category->exists ? 'Edit' : 'Tambah').' Kategori')
@section('content')
<h1 class="text-xl font-extrabold">{{ $category->exists ? 'Edit' : 'Tambah' }} Kategori</h1>
<form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" class="mt-4 bg-white rounded-3xl border p-6 grid gap-3 max-w-xl">@csrf @if($category->exists)@method('PUT')@endif
<label class="text-sm">Nama<input name="name" required value="{{ old('name', $category->name) }}" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm"></label>
<label class="text-sm">Deskripsi<textarea name="description" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm">{{ old('description', $category->description) }}</textarea></label>
<button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold text-sm">Simpan</button>
</form>
@endsection
