@extends('layouts.admin')
@section('title', ($product->exists ? 'Edit' : 'Tambah').' Produk')
@section('content')
<h1 class="text-xl font-extrabold">{{ $product->exists ? 'Edit' : 'Tambah' }} Produk</h1>
<form method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product->id) : route('admin.products.store') }}" class="mt-4 bg-white rounded-3xl border p-6 grid gap-3 max-w-2xl">@csrf @if($product->exists)@method('PUT')@endif
<label class="text-sm">Nama<input name="name" required value="{{ old('name', $product->name) }}" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm"></label>
<label class="text-sm">Kategori<select name="category_id" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm">@foreach($categories as $c)<option value="{{ $c->id }}" @selected(old('category_id', $product->category_id) == $c->id)>{{ $c->name }}</option>@endforeach</select></label>
<label class="text-sm">Deskripsi<textarea name="description" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm">{{ old('description', $product->description) }}</textarea></label>
<div class="grid grid-cols-2 gap-3">
<label class="text-sm">Harga<input name="price" type="number" required value="{{ old('price', $product->price ?? 0) }}" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm"></label>
<label class="text-sm">Stok<input name="stock" type="number" required value="{{ old('stock', $product->stock ?? 0) }}" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm"></label>
</div>
<div class="grid grid-cols-2 gap-3">
<label class="text-sm">Status<select name="status" class="mt-1 w-full px-4 py-2 border rounded-2xl text-sm"><option value="active" @selected(old('status', $product->status) === 'active')>active</option><option value="inactive" @selected(old('status', $product->status) === 'inactive')>inactive</option></select></label>
<label class="text-sm flex items-center gap-2 mt-6"><input type="checkbox" name="is_best_seller" value="1" @checked(old('is_best_seller', $product->is_best_seller))> Best Seller</label>
</div>
<label class="text-sm">Gambar<input type="file" name="image" class="mt-1 text-sm"></label>
<button class="px-4 py-3 rounded-full bg-[#2B1B12] text-white font-bold text-sm">Simpan</button>
</form>
@endsection
