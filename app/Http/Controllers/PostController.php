<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Validation\Rule;

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

    Public function create(){
        if (auth()->guest()){
            abort(403);
        }
        if (auth()->user()->email != 'user@gmail.com'){
            abort(403);
        }
        return view('admin.createPost');

    }
    public function store(){
//        ddd(request()->file('thumbnail'));
//            $path = request()->file('thumbnail')->store('thumbnails' );
//            return 'done' . $path;
        $attr = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'excerpt' => 'required',
            'body' => 'required',
            'slug'=> ['required' , Rule::unique('posts' , 'slug')],
            'category_id'=>[ 'required' , Rule::exists('categories','id')]

        ]);
        $attr['user_id'] = auth()->id();
        $attr['thumbnail'] =  request()->file('thumbnail')->store('thumbnails' );
//        ddd($attr);
        Post::create($attr);
        return redirect('/')->with('Success', 'Yay!! Ban Gyei Post');

    }


}
