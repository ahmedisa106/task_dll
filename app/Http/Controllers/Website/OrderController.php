<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function buy(Product $product, Request $request)
    {
        $exist_product = auth('web')->user()->products()->where('product_id', $product->id)->first();
        if (!is_null($exist_product)) {
            $exist_product->pivot->increment('quantity');
        } else {
            auth('web')->user()->products()->attach($product->id, ['quantity' => 1]);
        }
        return redirect()->back();
    }
}
