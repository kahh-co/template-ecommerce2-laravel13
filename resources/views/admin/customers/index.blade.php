@extends('layouts.admin')
@section('title', 'Customers — Admin')
@section('content')
<h1 class="text-xl font-extrabold">Customers</h1>
<div class="mt-4 bg-white rounded-3xl border overflow-hidden">
<table class="w-full text-sm"><thead class="bg-stone-100 text-left"><tr><th class="p-3">Name</th><th class="p-3">Email</th><th class="p-3">Orders</th></tr></thead>
<tbody>@foreach($customers as $c)<tr class="border-t"><td class="p-3 font-bold">{{ $c->name }}</td><td class="p-3">{{ $c->email }}</td><td class="p-3">{{ $c->orders_count }}</td></tr>@endforeach</tbody></table>
</div><div class="mt-3">{{ $customers->links() }}</div>
@endsection
