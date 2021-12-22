<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(){

            $author = Auth::user()->id;
//            $user_id = User::find($author);


                return view('admin.allPost',[
                    'posts' => Post::all()->where('user_id', '=' , $author),
                    'auth' => Auth::id(),
                ]);



    }
    public function edit(Post $post){
        return view('admin.editPost',['post' => $post]);
    }
    public function update(Post $post){
        $attr = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'excerpt' => 'required',
            'body' => 'required',
            'slug'=> ['required' , Rule::unique('posts' , 'slug')->ignore($post->id)],
            'category_id'=>[ 'required' , Rule::exists('categories','id')]

        ]);
        if (isset($attr['thumbnail'])){
            $attr['thumbnail'] =  request()->file('thumbnail')->store('thumbnails' );
        }
        $post->update($attr);
        return back()->with('Success','Post Updated');
    }
    public function destroy(Post $post){
        $post->delete();
        return back()->with('Success' , 'Sab mita diya');
    }
}
