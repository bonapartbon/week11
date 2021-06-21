<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::get();
        return view('admin.posts.index')->with('posts', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $input['user_id'] = Auth::id();

        Post::create($input);
        return redirect()->route('posts.index')
            ->with('success', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::get();
        if (Auth::user()->role !== 'admin' && Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Only Admins are allowed to access this page!');
        }
        return view('admin.posts.edit', ['post' => $post, 'categories' => $category]);

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index')
            ->with('success', 'Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Only Admins are allowed to access this page!');
        }
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post Deleted Successfully!');
    }
}
