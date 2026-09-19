<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $subtotal = $cart->items->sum(fn ($i) => $i->price * $i->quantity);
        $shipping = 10000;
        $total = $subtotal + $shipping;

        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request, MidtransService $midtrans)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'note' => 'nullable|string',
        ]);

        $cart = Cart::with('items.product')->where('user_id', auth()->id())->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $subtotal = $cart->items->sum(fn ($i) => $i->price * $i->quantity);
        $shipping = 10000;

        $order = DB::transaction(function () use ($data, $cart, $subtotal, $shipping) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'DD-'.strtoupper(Str::random(6)).'-'.time() % 10000,
                'customer_name' => $data['name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'note' => $data['note'] ?? null,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total_amount' => $subtotal + $shipping,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception('Stok '.$item->product->name.' tidak mencukupi.');
                }
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->price * $item->quantity,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        $midtrans->createTransaction($order->fresh());

        return redirect()->route('checkout.pay', $order->order_number)->with('success', 'Order dibuat! Silakan bayar.');
    }

    public function pay(string $orderNumber)
    {
        $order = Order::with('items')->where('user_id', auth()->id())
            ->where('order_number', $orderNumber)->firstOrFail();

        return view('checkout.pay', compact('order'));
    }
}
