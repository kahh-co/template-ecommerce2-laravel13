<?php

namespace App\Services;

use App\Models\Order;

/**
 * Mock Midtrans Snap service.
 * Struktur dibuat kompatibel dengan integrasi Midtrans asli:
 * - createTransaction() menghasilkan snap_token + redirect_url
 * - verifyNotification() memverifikasi signature backend
 * Saat MIDTRANS_MODE=snap dan server_key tersedia, class ini bisa
 * diganti isinya dengan panggilan \Midtrans\Snap::getSnapToken().
 */
class MidtransService
{
    public function createTransaction(Order $order): array
    {
        $order->loadMissing('items', 'user');

        if (config('midtrans.mode') === 'snap' && config('midtrans.server_key')) {
            return $this->createSnapTransaction($order);
        }

        $token = 'MOCK-'.strtoupper(uniqid());
        $order->update([
            'snap_token' => $token,
            'payment_reference' => $order->order_number,
        ]);

        return [
            'token' => $token,
            'redirect_url' => route('checkout.pay', $order->order_number),
            'client_key' => config('midtrans.client_key'),
            'is_mock' => true,
        ];
    }

    protected function createSnapTransaction(Order $order): array
    {
        // Placeholder integrasi asli — tetap aman jika package belum diinstall.
        // Aktifkan dengan: composer require midtrans/midtrans-php
        if (class_exists(\Midtrans\Config::class)) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'email' => $order->customer_email,
                    'phone' => $order->customer_phone,
                ],
            ];
            $token = \Midtrans\Snap::getSnapToken($params);
            $order->update(['snap_token' => $token, 'payment_reference' => $order->order_number]);

            return ['token' => $token, 'redirect_url' => route('checkout.pay', $order->order_number), 'client_key' => config('midtrans.client_key'), 'is_mock' => false];
        }

        return $this->createMockFallback($order);
    }

    protected function createMockFallback(Order $order): array
    {
        $token = 'MOCK-'.strtoupper(uniqid());
        $order->update(['snap_token' => $token, 'payment_reference' => $order->order_number]);

        return ['token' => $token, 'redirect_url' => route('checkout.pay', $order->order_number), 'client_key' => '', 'is_mock' => true];
    }

    /**
     * Verifikasi notification dari Midtrans / mock.
     * Untuk mock: signature = sha512(order_id . status_code . gross_amount . server_key_or_mock).
     */
    public function verifyNotification(array $payload): bool
    {
        if (config('midtrans.mode') === 'mock') {
            return isset($payload['order_id'], $payload['transaction_status']);
        }

        if (! isset($payload['signature_key'])) {
            return false;
        }
        $expected = hash('sha512', ($payload['order_id'] ?? '').($payload['status_code'] ?? '').($payload['gross_amount'] ?? '').config('midtrans.server_key'));

        return hash_equals($expected, $payload['signature_key']);
    }

    public function mapTransactionStatus(string $midtransStatus, string $fraud = 'accept'): string
    {
        return match ($midtransStatus) {
            'capture', 'settlement' => $fraud === 'challenge' ? 'pending' : 'paid',
            'pending' => 'pending',
            'deny', 'cancel', 'failure' => 'failed',
            'expire' => 'expired',
            default => 'pending',
        };
    }
}
