<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class InvitedUserController extends Controller
{
    public function edit(Request $request)
    {
        $token = $request->get('token');
        $formUrl = URL::temporarySignedRoute('invitation.accept', now()->addMinutes(15), ['token' => $token]);
        $user = User::where('invitation_token', $token)->firstOrFail();
        return view('auth.invitation')->with('user', $user)->with('form_url', $formUrl);
    }

    public function update(Request $request)
    {
        $token = $request->get('token');
        $user = User::where('invitation_token', $token)->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        $user->name = $request->get('name');
        $user->password = Hash::make($request->get('password'));
        $user->invitation_token = '';
        $user->save();
        $user->markEmailAsVerified();

        event(new Registered($user));

        return redirect()->route('login');
    }
}
