<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_products'])->only(['create', 'store']);
        $this->middleware(['permission:update_products'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_products'])->only(['destroy']);
        $this->middleware(['permission:read_products'])->only(['index']);
    }

    public function index(Category $category)
    {
        if (auth('admin')->user()->cannot('view', $category)) {
            abort(401);
        }
        $products = Product::query()->where('category_id', $category->id)->with('category')->orderByDesc('id')->get(['id', 'name', 'price', 'category_id']);
        return view('dashboard.pages.products.index', compact('products'));
    }

    public function create(Category $category)
    {
        return view('dashboard.pages.products.create');
    }

    public function store(Category $category, ProductRequest $request)
    {
        $data = $request->safe()->toArray();
        Product::query()->create($data);
        session()->flash('success', 'data stored successfully');
        return to_route('dashboard.products.index', $category->id);
    }

    public function edit(Category $category, Product $product)
    {
        return view('dashboard.pages.products.edit', compact('product', 'category'));
    }


    public function update(Category $category, ProductRequest $request, Product $product)
    {
        $data = $request->safe()->toArray();
        $product->update($data);
        session()->flash('success', 'data updated successfully');
        return to_route('dashboard.products.index', $category->id);
    }

    public function destroy(Category $category, Product $product)
    {

        $product->delete();
        session()->flash('success', 'data deleted successfully');
        return to_route('dashboard.products.index', $category->id);
    }
}
