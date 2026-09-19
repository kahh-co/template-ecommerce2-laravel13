<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        $bestSellers = Product::active()->with('category')
            ->where('is_best_seller', true)->take(4)->get();
        if ($bestSellers->count() < 4) {
            $bestSellers = Product::active()->with('category')->take(8)->get();
        }
        $latest = Product::active()->with('category')->latest()->take(4)->get();

        return view('home', compact('categories', 'bestSellers', 'latest'));
    }
}
