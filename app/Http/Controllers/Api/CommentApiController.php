<?php

namespace App\Http\Controllers\Api;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    public function store(Request $request,$id)
    {
        $post=Post::find($id);
        if(!$post){
            return response()->json(["message"=>"post not found"],404);
        }
        $request->validate([
            "content"=>"required|string"
        ]);
       $comment=new Comment([
            'post_id'=>$post->id,
            'user_id'=>Auth::user()->id,
            'content'=>$request->content
        ]);
        
       $post->comments()->save($comment);

       return response()->json(["message"=>"comment added successfully","comment"=>$comment],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post=Post::find($id);
        if(!$post){
            return response()->json(["message"=>"post not found"],404);
        }
        $comments_post=$post->comments;
        $comments_post=$comments_post->map(function($comment_post){
                    return[
                        'comment_id'=>$comment_post->id,
                        'content'=>$comment_post->content,
                        'user_id'=>$comment_post->user_id,
                        'created_at'=>$comment_post->created_at,
                    ];
                });
                return response()->json(["message"=>"show comments post successfuly","comments_post"=>$comments_post],200);

    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comment=Comment::find($id);
        if(!$comment){
            return response()->json(["message"=>"comment not found"],404);
        }
        $this->authorize("sameUsercomment",$comment);
        $request->validate([
            "content"=>"required|string"
        ]);
        $comment->update([
            'content' => $request->content,
        ]);
      
        return response()->json(["message"=>"comment updated successfuly","comment"=>$comment],200); 
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        if(!$comment){
            return response()->json(["message"=>"comment not found"],404);
        }
        $this->authorize("sameUsercommentorpost",$comment);
        $comment->delete();
        return response()->json(["message"=>"comment deleted successfully"],200);
    }
}
