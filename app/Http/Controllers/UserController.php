<?php
// UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegistrationForm()
    {   
        if (Auth::check()) {
            // User is logged in
            $user = Auth::user(); // Get the authenticated user
            // Your code for authenticated users goes here

            // Get the user ID
            $user_name = $user->name;

            $user_posts = $user->userPosts;
            
            return view('user_posts', ['user_name' => $user_name, 'user_posts'=> $user_posts])->with('success', 'Login successful!'); // Redirect to the dashboard or any other page

        } else {
            return view('register');
        }
    }

    public function register(Request $request)
    {
        // Validation (you can customize this based on your requirements)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user ->save();

        // Optionally, you can log in the user or perform other actions

        return redirect('/')->with('success', 'Registration successful!');
    }

    public function showLoginForm(){
    
        if (Auth::check()) {
            // Use Auth::user() to get the authenticated user
            $user = Auth::user();

            // Eager load the user's posts to avoid N+1 problem
            $userWithPosts = User::with('posts.category')->findOrFail($user->id);
            
            // Access the user's name and posts
            $userName = $userWithPosts->name;
            $userPosts = $userWithPosts->posts;

            // Pass data to the view using "with"
            return view('user_posts', ['user_name' => $userName, 'user_posts' => $userPosts])
                ->with('success', 'Login successful!');
        } else {
            // User is not logged in
            // Your code for guests (non-authenticated users) goes here
            return view('login'); // Assuming you have a login form view
        }
    }


    public function login(Request $request){

        // Validation
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        ]);
        

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Use Auth::user() to get the authenticated user
            $user = Auth::user();

            // Eager load the user's posts to avoid N+1 problem
            $userWithPosts = User::with('posts')->findOrFail($user->id);

            // Access the user's name and posts
            $userName = $userWithPosts->name;
            $userPosts = $userWithPosts->posts;

            // Pass data to the view using "with"
            return view('user_posts', ['user_name' => $userName, 'user_posts' => $userPosts])
                ->with('success', 'Login successful!');
        }

        // Authentication failed
        return redirect()->back()->withErrors(['error' => 'Invalid email or password'])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

}