<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        $posts=$posts->map(function($post){
            $user=User::find($post->user_id);
            $category=Category::find($post->category_id);
            $tags_post=$post->tags;
            $basePath="/storage";
            $imagePath=$post->image;
            $imag=url("$basePath/$imagePath");
            return[
                'post_id'=>$post->id,
                'user'=>$user->name,
                'title'=>$post->title,
                'description'=>$post->description,
                'image'=>$imag,
                'category'=>$category->title,
                'created_at'=>$post->created_at,
                'tags_post'=>$tags_post->map(function($tag_post){
           
                    return[
                        'tag_id'=>$tag_post->id,
                        'word'=>$tag_post->word,
                        'created_at'=>$tag_post->created_at,
                    ];
                }),

            ];
        });
        return response()->json(["message"=>"this is all posts","posts"=>$posts],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|string",
            "description"=>"required|string",
            "image"=>"required",
            "category_id"=>"required|integer",
            "tag_id" =>"required| array",
            "tag_id.*" => "required|integer"
        ]);
        
        
        $imageName=$request->file("image")->store('images/posts',"public");
   
        $post=new Post([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imageName,
            'category_id'=>$request->category_id,
            'user_id'=>Auth::user()->id,
        ]);
        $userid=Auth::user()->id;
        $user = User::find($userid);
        $postt=$user->posts()->save($post);
        $postt->tags()->attach($request->tag_id);
        return response()->json(["message"=>"post added successfully","post"=>$post],200);
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
        $tags_post=$post->tags;
        $comments_post=$post->comments;
        $user=User::find($post->user_id);
            $category=Category::find($post->category_id);
            $basePath="/storage";
            $imagePath=$post->image;
            $imag=url("$basePath/$imagePath");
            $post=[
                'post_id'=>$post->id,
                'user'=>$user->name,
                'title'=>$post->title,
                'description'=>$post->description,
                'image'=>$imag,
                'category'=>$category->title,
                'created_at'=>$post->created_at,
                'tags_post'=>$tags_post->map(function($tag_post){
           
                    return[
                        'tag_id'=>$tag_post->id,
                        'word'=>$tag_post->word,
                        'created_at'=>$tag_post->created_at,
                    ];
                }),
                'comments_post'=>$comments_post->map(function($comment_post){
           
                    return[
                        'comment_id'=>$comment_post->id,
                        'content'=>$comment_post->content,
                        'user_id'=>$comment_post->user_id,
                        'created_at'=>$comment_post->created_at,
                    ];
                })

            ];
            return response()->json(["message"=>"show post successfuly","post"=>$post],200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $post=Post::find($id);
        if(!$post){
            return response()->json(["message"=>"post not found"],404);
        }
        $this->authorize("sameUserpost",$post);
        if($request->file("image")){
            $request->validate([
                "title"=>"required|string",
                "description"=>"required|string",
                "image"=>"required",
                "category_id"=>"required|integer",
                "tag_id" =>"required| array",
                "tag_id.*" => "required|integer"
            ]);
            $imageName=$request->file("image")->store('images/posts',"public");
      
             $image_path=public_path("/images/posts/".$post->image);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
            $post->tags()->detach();
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id'=>Auth::user()->id,
                "image"=>$imageName,
                'category_id'=>$request->category_id
            ]);
            $post->tags()->attach($request->tag_id);
    

    
    
        }else{
            $request->validate([
                "title"=>"required|string",
                "description"=>"required|string",
                "category_id"=>"required|integer",
                "tag_id" =>"required| array",
                "tag_id.*" => "required|integer"
            ]);
            $post->tags()->detach();
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'user_id'=>Auth::user()->id,
                'category_id'=>$request->category_id,
            ]);
            $post->tags()->attach($request->tag_id);
        }
 
        return response()->json(["message"=>"post updated successfuly","post"=>$post],200);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $this->authorize("sameUserpost",$post);
        $post=Post::find($id);
        if(!$post){
            return response()->json(["message"=>"post not found"],404);
        }
        
            $image_path=public_path("/images/posts/".$post->image);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
           $post->tags()->detach();
            $post->delete();
            return response()->json(["message"=>"post deleted successfully"],200);

    }

    

}
