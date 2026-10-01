<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $data = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        $name = $data['loginname'];
        $password = $data['loginpassword'];

        if(auth()->attempt(['name' => $name, 'password' => $password])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }


    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        auth()->login($user);

        return redirect('/');
    }
}
