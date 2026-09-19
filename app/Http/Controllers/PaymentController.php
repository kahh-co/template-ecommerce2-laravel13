<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function notification(Request $request, MidtransService $midtrans)
    {
        $payload = $request->all();

        if (! $midtrans->verifyNotification($payload)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $payload['order_id'] ?? null;
        $status = $payload['transaction_status'] ?? 'pending';
        $fraud = $payload['fraud_status'] ?? 'accept';

        $order = Order::where('order_number', $orderId)->first();
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $paymentStatus = $midtrans->mapTransactionStatus($status, $fraud);
        $order->update([
            'payment_status' => $paymentStatus,
            'payment_reference' => $payload['transaction_id'] ?? $order->payment_reference,
            'order_status' => $paymentStatus === 'paid' ? 'processing' : ($paymentStatus === 'pending' ? $order->order_status : 'cancelled'),
        ]);

        return response()->json(['message' => 'OK']);
    }

    /** Simulasi pembayaran mock (pengganti Snap popup asli). */
    public function simulate(Request $request, string $orderNumber, MidtransService $midtrans)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        // Izinkan pemilik order atau admin
        if (auth()->check() && $order->user_id !== auth()->id() && ! auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate(['result' => 'required|in:settlement,pending,failure,expire,cancel']);

        $map = [
            'settlement' => 'paid',
            'pending' => 'pending',
            'failure' => 'failed',
            'expire' => 'expired',
            'cancel' => 'cancelled',
        ];

        $paymentStatus = $map[$request->result];
        $order->update([
            'payment_status' => $paymentStatus,
            'payment_reference' => 'MOCK-'.strtoupper(uniqid()),
            'order_status' => $paymentStatus === 'paid' ? 'processing' : ($paymentStatus === 'pending' ? $order->order_status : 'cancelled'),
        ]);

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Simulasi pembayaran: '.$paymentStatus);
    }
}
