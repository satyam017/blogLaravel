<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\sessionsController;
use App\Http\Controllers\PostCommentsController;
use \App\Http\Controllers\AdminPostController;
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

Route::post('newsletter',function (){
    request()->validate(['email' => 'email|required']);
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us20'
    ]);
    try {
        $response =   $mailchimp->lists->addListMember("2b3ce400e6",[
            "email_address" => request('email'),
            "status" => "subscribed"
        ]);
    }


    catch (\Exception $e){
        throw \Illuminate\Validation\ValidationException::withMessages([
           'newsemail' => 'I am not fool You MF trying to insert junk mail try some where else.'
        ]);
    }
    return redirect('/')->with('Success', 'You are now Subscribed MF');

});
Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');
Route::get('login', [sessionsController::class,'create'])->middleware('guest');
Route::post('session', [sessionsController::class,'store'])->middleware('guest');
Route::get('logout', [sessionsController::class,'destroy'])->middleware('auth');
Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);
Route::get('admin/posts/createPost',[PostController::class, 'create']);
Route::get('admin/posts/{post}/editPost', [AdminPostController::class , 'edit']);
Route::patch('admin/posts/{post}', [AdminPostController::class , 'update']);
Route::get('admin/posts/delete/{post}', [AdminPostController::class , 'destroy']);
Route::get('admin/posts/allPost',[AdminPostController::class, 'index']);
Route::post('admin/posts',[PostController::class, 'store'])->middleware('auth');

