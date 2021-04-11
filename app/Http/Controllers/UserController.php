<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('subscriptions')->orderBy('name', 'asc')->paginate(20);
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return redirect()->route('users.index');
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->allValidated());
        return redirect()->route('users.show', $user);
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->allValidated())->save();
        return redirect()->route('users.show', $user);
    }

    public function remove(User $user)
    {
        return view('users.remove')->with('user', $user);
    }

    public function destroy(User $user)
    {
        if( $user->removable() ) $user->delete();
        return redirect()->route('users.index');
    }
}
