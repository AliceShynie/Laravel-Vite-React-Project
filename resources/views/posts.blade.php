@extends('layouts.app')  
@section('posts')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome to My App') }}</div>

                    <div class="card-body">
                        <p>Explore our amazing features!</p>

                        <!-- "Sign Up" Button -->
                        <a href="{{ route('registration.form') }}" class="btn btn-primary">Sign Up</a>

                        <!-- "Sign In" Button -->
                        <a href="{{ route('login.form') }}" class="btn btn-primary">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <article>
        <div class="card">
            <form class="card-body" action="{{ url('/search_post') }}" method="GET">
                <div class="col-md-6">
                    <input 
                    type="text" 
                    class="form-control_2" 
                    name="query" 
                    value="{{ request('query') }}" 
                    placeholder="Search posts">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </article>
   

    @foreach($posts as $post)
    <article>
        <div class="card">
            <div class="card-body"><h1><a href="/posts/<?= $post->id;?>"><?= $post->title; ?></a></h1>
            <a href="/user/{{$post->user->id}}"><?= $post->user->name;?></a> in <a href="/category/{{$post->category->id}}"><?= $post->category->name;?></a>
            <div><p><?= $post->excerpt;?></p></div>
        </div>
    </article>

    @endforeach


    

