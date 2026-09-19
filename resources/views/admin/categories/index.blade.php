@extends('layouts.admin')
@section('title', 'Categories — Admin')
@section('content')
<div class="flex items-center justify-between"><h1 class="text-xl font-extrabold">Categories</h1><a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-full bg-[#2B1B12] text-white text-sm font-bold">+ Tambah</a></div>
<div class="mt-4 bg-white rounded-3xl border overflow-hidden">
<table class="w-full text-sm"><thead class="bg-stone-100 text-left"><tr><th class="p-3">Name</th><th class="p-3">Products</th><th class="p-3"></th></tr></thead>
<tbody>@foreach($categories as $c)<tr class="border-t"><td class="p-3 font-bold">{{ $c->name }}</td><td class="p-3">{{ $c->products_count }}</td>
<td class="p-3 flex gap-2"><a href="{{ route('admin.categories.edit', $c->id) }}" class="text-orange-700 font-bold">Edit</a><form action="{{ route('admin.categories.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-600 font-bold">Hapus</button></form></td></tr>@endforeach</tbody></table>
</div><div class="mt-3">{{ $categories->links() }}</div>
@endsection
