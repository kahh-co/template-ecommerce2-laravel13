@extends('layouts.app')
@section('title', 'Payment — '.$order->order_number)
@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <div class="bg-white rounded-3xl border shadow p-8 text-center">
        <div class="text-xs font-bold tracking-widest text-orange-700">MOCK MIDTRANS SNAP</div>
        <h1 class="text-2xl font-extrabold mt-1">Bayar Pesananmu</h1>
        <div class="mt-2 text-sm text-stone-500">Order: <b>{{ $order->order_number }}</b> • Snap Token: <code>{{ $order->snap_token }}</code></div>
        <div class="mt-4 text-3xl font-extrabold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</div>
        <div class="mt-2 text-xs">Payment: <b>{{ $order->payment_status }}</b> • Order: <b>{{ $order->order_status }}</b></div>
        <div class="mt-6 grid grid-cols-2 gap-2">
            <form method="POST" action="{{ route('payment.simulate', $order->order_number) }}">@csrf<input type="hidden" name="result" value="settlement"><button class="w-full px-4 py-3 rounded-2xl bg-green-600 text-white font-bold text-sm">✅ Simulasi Berhasil</button></form>
            <form method="POST" action="{{ route('payment.simulate', $order->order_number) }}">@csrf<input type="hidden" name="result" value="pending"><button class="w-full px-4 py-3 rounded-2xl bg-yellow-500 text-white font-bold text-sm">⏳ Pending</button></form>
            <form method="POST" action="{{ route('payment.simulate', $order->order_number) }}">@csrf<input type="hidden" name="result" value="failure"><button class="w-full px-4 py-3 rounded-2xl bg-red-600 text-white font-bold text-sm">❌ Gagal</button></form>
            <form method="POST" action="{{ route('payment.simulate', $order->order_number) }}">@csrf<input type="hidden" name="result" value="expire"><button class="w-full px-4 py-3 rounded-2xl bg-stone-600 text-white font-bold text-sm">⌛ Expired</button></form>
        </div>
        <a href="{{ route('orders.show', $order->order_number) }}" class="mt-6 inline-block text-sm font-bold text-orange-700">Lihat Order →</a>
        <p class="mt-4 text-[11px] text-stone-400">Mode mock aktif. Untuk Midtrans asli: isi MIDTRANS_SERVER_KEY/CLIENT_KEY, set MIDTRANS_MODE=snap, install midtrans/midtrans-php.</p>
    </div>
</div>
@endsection
