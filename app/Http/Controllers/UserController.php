<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserInvitation;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('subscriptions')->orderBy('name', 'asc')->paginate(20);
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        $user = new User();
        return view('users.edit')->with('user', $user);
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->allValidated());
        $user->password = Str::random(20);
        $user->invitation_token = Str::random(30);
        $user->save();

        Mail::send(new UserInvitation($user));

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

    public function reinvite(User $user)
    {
        if( $user->invitation_token == '' ) abort(400);
        Mail::send(new UserInvitation($user));
        return redirect()->route('users.show', $user);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile')->with('user', $user);
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('users.profile-edit')->with('user', $user);
    }

    public function updateProfile(AdminProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if( $request->filled('password') ) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();
        return redirect()->route('admin.profile');
    }
}
