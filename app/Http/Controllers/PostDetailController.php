<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostDetailController extends Controller
{
    //
    public function index(Post $post){
        return view('PostDetail',[
            'post' => $post
        ]);
    }
}
