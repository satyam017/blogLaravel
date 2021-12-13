<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//use Nette\Schema\ValidationException;
use Illuminate\Validation\ValidationException;

class sessionsController extends Controller
{
    public function destroy(){
//        ddd('log the user out');
        auth()->logout();
        return  redirect('/')->with('Success', 'Goodbye');
    }
    public function create(){
        return view('login.create');
    }
    public function store(){
        $attr= request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(auth()->attempt($attr)){
            session()->regenerate();
            return redirect('/')->with('Success', 'Welcome Back You Nub');
        }
//        else{
//
////            return back()
////                ->withInput()
////                ->withErrors(['email'=> 'Your Provided Email could not be verified']);
////            second method with validatgion exceotion
//        }
        throw ValidationException::withMessages(
            [
                'email'=> 'Your provided credential could not be verified. '
            ]
        );
    }
}
