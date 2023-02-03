<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function createPage() {
        $roles = User::getRoles();
        return view('admin.users.create', compact('roles'));
    }

    public function delete(User $user) {
        $user->delete();

        return redirect()->route('admin.user.index');
    }

    public function editPage(User $user) {
        $roles = User::getRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::firstOrCreate(['email'=>$data['email']], $data);

        return redirect()->route('admin.user.index');
    }

    public function update(UpdateRequest $request, User $user) {
        $data = $request->validated();
        $user->update($data);

        return view('admin.users.show', compact('user'));
    }

}
