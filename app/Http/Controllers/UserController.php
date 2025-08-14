<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function index()
        {
            $user = Auth::user();
            return view('panel.page.profile.index', compact('user'));
        }

        public function updates(Request $request)
        {
            $request->validate([
                'email'    => 'required|email|unique:users,email,' . Auth::id(),
                'password' => 'nullable|min:8|confirmed',
            ]);

            $user = Auth::user();
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return back()->with('success', 'Profile updated successfully!');
        }

}
