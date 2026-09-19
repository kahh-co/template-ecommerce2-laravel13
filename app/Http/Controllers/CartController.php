<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function cart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => auth()->id()]);
    }

    public function index()
    {
        $cart = $this->cart()->load('items.product.category');

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $product = Product::active()->findOrFail($request->product_id);
        $qty = (int) ($request->quantity ?? 1);

        if ($product->stock < $qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->cart();
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->update([
                'quantity' => $item->quantity + $qty,
                'price' => $product->price,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', $product->name.' masuk keranjang!');
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);
        $cart = $this->cart();
        $item = $cart->items()->findOrFail($id);

        if ($item->product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function destroy(int $id)
    {
        $cart = $this->cart();
        $cart->items()->findOrFail($id)->delete();

        return back()->with('success', 'Item dihapus.');
    }
}
