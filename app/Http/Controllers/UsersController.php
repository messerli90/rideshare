<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('users.dashboard')->withUser($user);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit')->withUser($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate
        $this->validate($request, [
            'home_city'     => 'required|alpha',
            'home_state'    => 'required',
            'phone_number'  => 'required|numeric',
        ]);

        // Update User
        $user->update([
            'home_city'     => $request->get('home_city'),
            'home_state'    => $request->get('home_state'),
            'phone_number'  => $request->get('phone_number'),
        ]);

        return view('users.dashboard')->withUser($user);
    }

    public function profile(User $user)
    {
        return view('users.profile', ['user' => $user]);
    }
}
