@extends('layouts.app')
@section("title","add post")
@section("content")

 <h1 class="mt-5 mb-5">add new post</h1>
 <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input class="form-control" type="text" name="title" placeholder="post title">
    <br>
    <textarea class="form-control" name="description" placeholder="post placeholder" ></textarea>
    <br>
    <input class="form-control" type="file" name="image" >
    <br>
    <label for="mycategory">Select Post Category:</label>
    <select class="form-control" name="category_id" id="mycategory" >
      @foreach ($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
      @endforeach
    </select>
    <br>
    <label for="mytag">Select Post Tags:</label>
    <select class="form-control" name="tag_id[]" id="mytag" multiple >
      @foreach ($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->word}}</option>
      @endforeach
    </select>
    <br>

    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 
 @endsection