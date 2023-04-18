<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepo;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_categories'])->only(['create', 'store']);
        $this->middleware(['permission:update_categories'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories'])->only(['destroy']);
        $this->middleware(['permission:read_categories'])->only(['index']);
    }

    public function index(CategoryRepo $repo)
    {
        $categories = $repo->get(['id', 'name'], 'products');
        return view('dashboard.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.pages.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->safe()->toArray();
        Category::query()->create($data);
        session()->flash('success', 'data stored successfully');
        return to_route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        if (auth('admin')->user()->cannot('update', $category)) {
            abort(401);
        }
        return view('dashboard.pages.categories.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->safe()->toArray();
        $category->update($data);
        session()->flash('success', 'data updated successfully');
        return to_route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'data deleted successfully');
        return to_route('dashboard.categories.index');
    }
}
