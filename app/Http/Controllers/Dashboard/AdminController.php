<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Models\Admin;
use App\Models\Permission;
use App\Repositories\CategoryRepo;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_admins'])->only(['create', 'store']);
        $this->middleware(['permission:update_admins'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_admins'])->only(['destroy']);
        $this->middleware(['permission:read_admins'])->only(['index']);
    }

    public function index()
    {
        $admins = Admin::query()->orderByDesc('id')->whereNot('is_super_admin', true)->get(['id', 'name', 'email']);
        return view('dashboard.pages.admins.index', compact('admins'));
    }

    public function create(CategoryRepo $repo)
    {
        $categories = $repo->get(['id', 'name']);
        $permissions = Permission::query()->get(['id', 'display_name']);
        return view('dashboard.pages.admins.create', compact('categories', 'permissions'));
    }

    public function store(AdminRequest $request)
    {
        $data = $request->safe()->except('categories', 'permissions');
        $categories = $request->categories;
        $permissions = $request->permissions;
        $data['password'] = bcrypt($request->password);
        DB::beginTransaction();
        $admin = Admin::query()->create($data);
        $admin->categories()->attach($categories);
        $admin->addRole('admin');
        $admin->givePermissions($permissions);
        DB::commit();
        session()->flash('success', 'data stored successfully');
        return to_route('dashboard.admins.index');
    }

    public function edit(Admin $admin, CategoryRepo $repo)
    {

        $categories = $repo->get(['id', 'name']);
        $permissions = Permission::query()->get(['id', 'display_name']);
        return view('dashboard.pages.admins.edit', compact('admin', 'categories', 'permissions'));
    }


    public function update(AdminRequest $request, Admin $admin)
    {
        $data = $request->safe()->except(['categories', 'permissions']);
        $categories = $request->categories;
        $permissions = $request->permissions;
        $data['password'] = $request->password == null ? $admin->password : bcrypt($request->password);
        DB::beginTransaction();
        $admin->update($data);
        $admin->categories()->sync($categories);
        $admin->syncPermissions($permissions);
        DB::commit();
        session()->flash('success', 'data updated successfully');
        return to_route('dashboard.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success', 'data deleted successfully');
        return to_route('dashboard.admins.index');
    }
}
