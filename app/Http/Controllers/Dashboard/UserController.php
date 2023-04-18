<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_users'])->only(['create', 'store']);
        $this->middleware(['permission:update_users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
        $this->middleware(['permission:read_users'])->only(['index']);
    }

    public function index()
    {
        $users = User::query()->orderByDesc('id')->get(['id', 'name', 'email']);
        return view('dashboard.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->safe()->toArray();
        $data['password'] = bcrypt($request->password);
        $user = User::query()->create($data);
        $user->addRole('user');
        session()->flash('success', 'data stored successfully');
        return to_route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.pages.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        $data = $request->safe()->toArray();
        $data['password'] = $request->password == null ? $user->password : bcrypt($request->password);
        $user->update($data);
        session()->flash('success', 'data updated successfully');
        return to_route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'data deleted successfully');
        return to_route('dashboard.users.index');
    }
}
