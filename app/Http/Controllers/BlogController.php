<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('publishdate', 'desc')->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'text' => 'required',
            'publishdate' => 'required|date',
            'category' => 'required|max:255',
            'tag' => 'required|max:255',
            'country' => 'required|max:255',
            'author' => 'required|max:255',
            'comments' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog = new Blog($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog-images', 'public');
            $blog->image = $imagePath;
        }

        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|max:255',
            'text' => 'required',
            'publishdate' => 'required|date',
            'category' => 'required|max:255',
            'tag' => 'required|max:255',
            'country' => 'required|max:255',
            'author' => 'required|max:255',
            'comments' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blog->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog-images', 'public');
            $blog->image = $imagePath;
        }

        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }
}