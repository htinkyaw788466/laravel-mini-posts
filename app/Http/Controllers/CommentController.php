<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required'
        ]);

        $comment=new Comment();
        $comment->content=$request->content;
        $comment->post_id=$request->post_id;
        $comment->user_id=auth()->user()->id;
        $comment->save();
        return redirect()->back()
               ->with('successMsgComment','comment add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        $comment=Comment::findOrFail($id);

        //authrization delete comment method one
        // if($comment->user_id==auth()->user()->id){
        //     $comment->delete();
        //     return redirect()->route('posts.edit',$post->id)
        //            ->with('deleteCommentMsg','comment remove successfully');
        // }else{
        //         return back()->with('error','unauthorize');
        //     }

        //authrization delete comment method two
        // if(Gate::denies('comment-delete',$comment)){
        //         return back()->with('error','unauthorize');
        //     }
        // $comment->delete();
        // return redirect()->route('posts.edit',$post->id)
        //            ->with('deleteCommentMsg','comment remove successfully');

        //authrization delete comment method three
        if(Gate::allows('comment-delete',$comment)){
            $comment->delete();
            return redirect()->route('posts.edit',$post->id)
                   ->with('deleteCommentMsg','comment remove successfully');
        }else{
            return back()->with('error','unauthorize');
        }
    }

}
