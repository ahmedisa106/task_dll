<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()->get(['id', 'name', 'price']);
        return view('website.index', compact('products'));
    }
}
