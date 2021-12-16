<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\sessionsController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class,'index']);

Route::get('posts/{post:slug}', [PostDetailController::class, 'index']);

Route::get('categories/{category:slug}', function(Category $category){
    return view('welcome',[
        'posts'=> $category->posts->load(['category','author']),
        'currentCategory' => $category,
        'categories'=> Category::all()
    ]);
});

Route::get('authors/{author}', function(User $author){
    // dd($author);
    return view('welcome',[
        'posts'=>$author->posts->load(['category','author']),
        'categories'=> Category::all()
    ]);
});

Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');
Route::get('login', [sessionsController::class,'create'])->middleware('guest');
Route::post('session', [sessionsController::class,'store'])->middleware('guest');
Route::get('logout', [sessionsController::class,'destroy'])->middleware('auth');
Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);
