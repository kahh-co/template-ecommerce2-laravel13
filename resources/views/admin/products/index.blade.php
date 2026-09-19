@extends('layouts.admin')
@section('title', 'Products — Admin')
@section('content')
<div class="flex items-center justify-between"><h1 class="text-xl font-extrabold">Products</h1><a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-full bg-[#2B1B12] text-white text-sm font-bold">+ Tambah</a></div>
<div class="mt-4 bg-white rounded-3xl border overflow-hidden">
<table class="w-full text-sm"><thead class="bg-stone-100 text-left"><tr><th class="p-3">Name</th><th class="p-3">Category</th><th class="p-3">Price</th><th class="p-3">Stock</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead>
<tbody>@foreach($products as $p)<tr class="border-t"><td class="p-3 font-bold">{{ $p->name }}</td><td class="p-3">{{ $p->category->name }}</td><td class="p-3">Rp{{ number_format($p->price, 0, ',', '.') }}</td><td class="p-3">{{ $p->stock }}</td><td class="p-3">{{ $p->status }}</td>
<td class="p-3 flex gap-2"><a href="{{ route('admin.products.edit', $p->id) }}" class="text-orange-700 font-bold">Edit</a><form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-600 font-bold">Hapus</button></form></td></tr>@endforeach</tbody></table>
</div><div class="mt-3">{{ $products->links() }}</div>
@endsection
