<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ], [], [
            'current_password' => 'joriy parol',
            'password' => 'yangi parol',
        ]);

        if (! Hash::check($data['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => 'Joriy parol noto‘g‘ri.']);
        }

        $request->user()->forceFill([
            'password' => Hash::make($data['password']),
            'remember_token' => null,
        ])->save();

        $request->session()->regenerate();

        return redirect()->route('admin.password.edit')->with('success', 'Parol yangilandi.');
    }
}
