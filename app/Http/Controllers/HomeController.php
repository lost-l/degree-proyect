<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::where('stock', '>', '0')
            ->orderByDesc('updated_at')
            ->limit(2)->get();
        $categories = Category::limit(3)->get();
        return view('welcome', compact('products', 'categories'));
    }
}
