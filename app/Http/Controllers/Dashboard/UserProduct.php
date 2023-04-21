<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserProduct extends Controller
{
    public function index()
    {
        $auth_products_ids = auth('admin')->user()->products()->pluck('id')->toArray();

        $users = User::query()->with('products')->withCount(['products' => function ($q) use ($auth_products_ids) {
            $q->whereIn('product_id', $auth_products_ids);
        }])->whereHas('products', function ($q) use ($auth_products_ids) {
            $q->whereIn('product_id', $auth_products_ids);
        })->get(['id', 'name', 'email']);

        return view('dashboard.pages.user_products.index', compact('users'));
    }

    public function view_products(User $user)
    {
        $products = auth('admin')->user()->my_products_sold($user);
        return view('dashboard.pages.user_products.show', compact('products'));
    }
}
