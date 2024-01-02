@extends('layouts.app')  
@section('user_post')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>Welcome, {{ $user_name }}</h1>

                <div class="card">
                <div class="card-body">
                    <h3>Log your new entry</h3>
                    <form method="POST" action="{{ url('/blogs/create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Slug') }}</label>
                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control" name="slug" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Excerpt') }}</label>
                            <div class="col-md-6">
                                <input id="excerpt" type="text" class="form-control" name="excerpt" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <input id="category" class="form-control" name="category" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>
                            <div class="col-md-6">
                                <textarea id="body" class="form-control" name="body" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('New Entry') }}
                        </button>

                    </form>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                </div>
                <h3>Old entries</h3>
               @foreach($user_posts as $post)
                    <article>
                        <div class="card">
                            <div class="card-body"><h1><a href="login/posts/<?= $post->id;?>"><?= $post->title; ?></a></h1>
                                <a href="/user/{{$post->user->id}}"><?= $post->user->name;?></a> in <a href="/category/{{$post->category->id}}"><?= $post->category->name;?></a>
                            <div><p><?= $post->excerpt;?></p></div>
                        </div>
                    </article>
                @endforeach
               
            </div>
        </div>
        <form method="GET" action="{{ url('/logout') }}">
            <button type="submit" class="btn btn-primary">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
@endsection