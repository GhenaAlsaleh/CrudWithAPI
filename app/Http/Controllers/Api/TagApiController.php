<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
class TagApiController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::all();
        return response()->json(["message"=>"this is all tags","tags"=>$tags],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "word"=>"required|string|max:255"
        ]);
        $tag=Tag::create([
            "word"=>$request->word
        ]);
        return response()->json(["message"=>"tag added successfully","tag"=>$tag],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag=Tag::find($id);
        if(!$tag){
            return response()->json(["message"=>"tag not found"],404);
        }
        return response()->json(["message"=>"show tag successfuly","tag"=>$tag],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $tag=Tag::find($id);
        if(!$tag){
            return response()->json(["message"=>"tag not found"],404);
        }
         $request->validate([
            "word"=>"required|string|max:255"
        ]);
        $tag->update([
            "word"=>$request->word
        ]);

        return response()->json(["message"=>"tag updated successfuly","tag"=>$tag],200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag=Tag::find($id);
        if(!$tag){
            return response()->json(["message"=>"tag not found"],404);
        }
        $tag->delete();
        return response()->json(["message"=>"tag deleted successfully"],200);
    }
}

