<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Admin extends Authenticatable implements LaratrustUser
{
    use HasFactory, HasRolesAndPermissions;

    protected $guarded = [];
    protected $table = 'admins';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'admin_categories', 'admin_id', 'category_id');
    }

    public function my_products_sold($user)
    {
        return Product::query()->join('user_products', 'products.id', '=', 'user_products.product_id')
            ->where('user_products.user_id', $user->id)
            ->whereIn('user_products.product_id', $this->products()->pluck('id')->toArray())
            ->select('products.*', 'user_products.quantity')->get();
    }

    public function get_auth_products_ids()
    {
        $auth_products_ids = [];
        $auth_categories_products_ids = auth('admin')->user()->categories;
        foreach ($auth_categories_products_ids as $auth_categories_products_id) {
            $auth_products_ids[] = $auth_categories_products_id->products->pluck('id')->toArray();
        }
        return Arr::collapse($auth_products_ids);

    }

    public function products()
    {
        $products = Product::query()->join('categories', 'products.category_id', '=', 'categories.id');
        if (!auth('admin')->user()->is_super_admin) {
            $products = $products->clone()
                ->join('admin_categories', 'categories.id', '=', 'admin_categories.category_id')
                ->where('admin_categories.admin_id', auth('admin')->id());
        }
        return $products->select('products.*')->get()->unique('id');
    }


}
