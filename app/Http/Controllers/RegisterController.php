<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store(){
//        return request()->all();
        $attr=request()->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:7|max:255',
            ]);
//        $attr['password'] = bcrypt($attr['password']); // way one to encrypt password
        $user=User::create($attr);
        //log the user
        auth()->login($user);
        return redirect('/')->with('Success','Your Account has been created');

    }
}
