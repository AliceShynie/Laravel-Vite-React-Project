<?php

namespace App\Models;

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/api/data', function () {
    $data = Post::latest()->with('category')->get();
    return response()->json($data);
});

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/login');
    }else{
        
       return view('posts',['posts'=> Post::latest()->with('category')->get()]); 
    }
    
});

Route::get('/posts/{post}', function ($id) {
    $post = Post::findOrFail($id);
    
    return view('post', [
        'post' => $post
    ]);

});
Route::get('/login/posts/{post}', function ($id) {
    $post = Post::findOrFail($id);
    
    return view('login_post', [
        'post' => $post
    ]);

});
Route::get('/category/{category}', function (Category $category) {
    return view('post_category', [
        'posts' => $category ->posts ->load(['category','user'])
    ]);

});
Route::get('/user/{user}', function (User $user){
    return view('post_category', [
        'posts' => $user ->posts ->load(['category','user'])
    ]);
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('registration.form');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class,'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class,'login']);
Route::get('/logout', [UserController::class,'logout']);
Route::post('/blogs/create', [BlogController::class, 'create']);
Route::get('/blogs/edit/{id}', [BlogController::class, 'editForm']);
Route::put('/blogs/update/{id}', [BlogController::class, 'update']);
Route::delete('/blogs/delete/{id}', [BlogController::class, 'delete']);
Route::get('/search_post', [BlogController::class, 'search'])->name('posts.search');


# to test if the database is connected
Route::get('/test-database-connection', function () {
    try {
        # The PDO instance is a PHP extension that 
        # provides a uniform method of access to multiple databases
        # built in php function
        DB::connection()->getPdo();
        return "Connected to the database!";
    } catch (\Exception $e) {
        return "Unable to connect to the database. Error: " . $e->getMessage();
    }
});