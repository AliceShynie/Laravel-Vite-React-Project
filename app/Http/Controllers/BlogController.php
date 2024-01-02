<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    // Show a form to create a new blog entry
    public function create(Request $request)
    {
        if (Auth::check()) {
            // Your logic to display the create form
            $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:500',
            'excerpt' => 'required|string|max:500',
            'category' => 'required|integer',
            'body' => 'required|string|min:10',
            ]);

            // Clean individual fields
            $cleanTitle = $validatedData['title'];
            $cleanSlug = $validatedData['slug'];
            $cleanExcerpt = $validatedData['excerpt'];
            $cleancategory = $validatedData['category'];
            $cleanBody = $validatedData['body'];

            // Create a new post
            $post = [
            'title' => $cleanTitle,
            'slug' => $cleanSlug,
            'excerpt' => $cleanExcerpt,
            'category_id' => $cleancategory,
            'body' => $cleanBody,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
            ];

            Post::create($post);

            return redirect('/login')->with('success', 'Blog Added Successfully!');

        } else {

            return redirect('/login')->with('fail', 'Blog Not Added Successfully!');
        }
    }

    public function editForm($id)
    {
        $blog = Post::findOrFail($id); // Retrieve the blog by its ID

        return view('user_post_edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:500',
            'excerpt' => 'required|string',
            'body' => 'required|string',
        ]);

        $blog = Post::findOrFail($id); // Retrieve the blog by its ID

        $blog->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
        ]);

        return redirect('/')->with('success', 'Blog updated successfully!');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id); // Retrieve the blog by its ID

        // Delete the blog entry
        $post->delete();

        return redirect('/')->with('success', 'Blog deleted successfully!');
    }

    public function search(Request $request)
    {
        
        if ($request->filled('query')){
            $query = $request->input('query');
            // Perform a search query using the entered text
            $posts = Post::where('title', 'like', "%$query%")
                         ->orWhere('body', 'like', "%$query%")
                         ->latest()
                         ->with('category')
                         ->get();
    
            return view('posts', compact('posts'));
        }else{
            return redirect('/');
        }
    }
}
