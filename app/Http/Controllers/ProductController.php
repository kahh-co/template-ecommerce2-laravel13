<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Product::active()->with('category');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }
        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }
        match ($request->get('sort')) {
            'termurah' => $query->orderBy('price', 'asc'),
            'termahal' => $query->orderBy('price', 'desc'),
            'best' => $query->orderByDesc('is_best_seller')->latest(),
            default => $query->latest(),
        };

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (int) $request->max_price);
        }

        $products = $query->paginate(12)->withQueryString();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::active()->with('category')->where('slug', $slug)->firstOrFail();
        $related = Product::active()->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(4)->get();

        return view('products.show', compact('product', 'related'));
    }
}
