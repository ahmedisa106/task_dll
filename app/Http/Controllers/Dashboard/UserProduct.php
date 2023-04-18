<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserProduct extends Controller
{
    public function index()
    {
        if (auth('admin')->user()->is_super_admin) {
            $users = User::query()->with('products')->withCount('products')->whereHas('products')->get(['id', 'name', 'email']);
        } else {
            $auth_products_ids = auth('admin')->user()->get_auth_products_ids();
            $users = User::query()->with('products')->whereHas('products', function ($q) use ($auth_products_ids) {
                $q->whereIn('product_id', $auth_products_ids);
            })->withCount(['products' => function ($q) use ($auth_products_ids) {
                $q->whereIn('product_id', $auth_products_ids);
            }])->get(['id', 'name', 'email']);
        }

        return view('dashboard.pages.user_products.index', compact('users'));
    }

    public function view_products(User $user)
    {
        $products = auth('admin')->user()->my_products_sold($user);
        return view('dashboard.pages.user_products.show', compact('products'));
    }
}
