<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    Public function index(){
//    return Post::latest()->filter(request
//    (['search','category','author']))->paginate();


        return view('welcome',[
            'posts'=>  Post::latest()->filter(request(['search']))->paginate(6)->withQueryString(),
            'categories' => Category::all(),
            'author' => User::all()
        ]);
    }



}
