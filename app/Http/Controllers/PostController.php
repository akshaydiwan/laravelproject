<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['categories','user'])->paginate(3);
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
      
        
        $filename = sprintf('thumbnail_%s.jpg', random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        $filename = $request->file('thumbnail')->storeAs('post/images', $filename , 'public');
        else{
            $filename = 'dummy.jpg';
        }
        
        $post =[
            'user_id'=>$request->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
         
            'thumbnail'=>$filename,
            'slug'=>$request->title,
        ];
      
        $post = Post::create($post);
        $post->categories()->attach($request->categories);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $response = Gate::inspect('view');
        if($response->denied()){
        return redirect()->back()->with('status', $response->message());
        }
        $categories= \App\Models\Category::all();
        return view('dashboard.posts.show',compact('categories','post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $response = Gate::inspect('update', $post);
        if($response->denied()){
        return redirect()->back()->with('status', $response->message());
        }
        
        $categories = \App\Models\Category::all();
        return view('dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $response = Gate::inspect('update', $post);
        if($response->denied()){
        return redirect()->back()->with('status', $response->message());
        }
        $filename = sprintf('thumbnail_%s.jpg', random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        $filename = $request->file('thumbnail')->storeAs('post/images', $filename , 'public');
        else{
            $filename = $post->thumbnail;
        }
        
       
            $post->user_id = $request->user()->id;
            $post->title = $request->title;
            $post->content = $request->content;
         
            $post->thumbnail = $filename;
            $post->slug = $request->title;
        
      
        $save = $post->update();
        $post->categories()->sync($request->categories);
        if($save){
        return redirect()->route('posts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $response = Gate::inspect('delete', $post);
        if($response->denied()){
        return redirect()->back()->with('status', $response->message());
        }
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('posts.index');

    }
}
