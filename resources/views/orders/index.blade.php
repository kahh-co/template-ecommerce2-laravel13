@extends('layouts.app')
@section('title', 'Orders — DAILYDRINK')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-extrabold">Order History</h1>
    <div class="mt-4 bg-white rounded-3xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-cream-100 text-left"><tr><th class="p-4">Order ID</th><th class="p-4">Date</th><th class="p-4">Total</th><th class="p-4">Payment</th><th class="p-4">Status</th><th class="p-4"></th></tr></thead>
            <tbody>
            @forelse($orders as $o)
            <tr class="border-t">
                <td class="p-4 font-bold">{{ $o->order_number }}</td>
                <td class="p-4">{{ $o->created_at->format('d M Y') }}</td>
                <td class="p-4">Rp{{ number_format($o->total_amount, 0, ',', '.') }}</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full text-xs font-bold {{ $o->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">{{ ucfirst($o->payment_status) }}</span></td>
                <td class="p-4">{{ ucfirst($o->order_status) }}</td>
                <td class="p-4"><a href="{{ route('orders.show', $o->order_number) }}" class="font-bold text-orange-700">Detail</a></td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-8 text-center text-stone-500">Belum ada order.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection
