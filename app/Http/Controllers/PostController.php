<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $limited=5;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
       $this->middleware('auth')->except(['index','show']);
    }
    public function index()
    {
        $posts=Post::latest()->simplePaginate($this->limited);
        return view('posts/index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('posts/create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:50',
            'body'=>'required',
        ]);

        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->route('all.posts')
               ->with('successMsg','post added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post=Post::findOrFail($id);
        return view('posts/show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Category::all();
        $post=Post::findOrFail($id);
        if(Gate::allows('post-edit',$post)){
            return view('posts/edit',compact(['categories','post']));
        }else{
            return redirect()->route('posts.show',$post->id)
                   ->with('error','unauthorize');
        }
        //return view('posts/edit',compact(['categories','post']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post=Post::findOrFail($id);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->route('posts.show',$post->id)
               ->with('successMsg','post edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::findOrFail($id);
        if(Gate::allows('post-delete',$post)){
            $post->delete();
            return redirect()->route('all.posts')
                   ->with('alertMsg','post delete successfully');
        }else{
            return redirect()->route('posts.edit',$post->id)
                   ->with('error','unauthorize');
        }


    }

}
