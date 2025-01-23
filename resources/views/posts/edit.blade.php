@extends('layouts.app')
@section("title","edit post")
@section("content")

 <h1 class="mt-5 mb-5">edit {{ $post->title }} post</h1>
 <form action="{{route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="title" placeholder="post title" value="{{ $post->title }}">
    <br>
    <textarea class="form-control" name="description" placeholder="post placeholder" >{{$post->description}}</textarea>
    <br>
    <input class="form-control" type="file" name="image" id="image">
    <lable for="image">
     <img src="/images/posts/{{$post->image}}">
    </lable>
    <br>
    <label for="mycategory">Select Post Category:</label>
    <select class="form-control" name="category_id" id="mycategory" >
      @foreach ($categories as $category)
      <option value="{{$category->id}}"{{ ( $category->id == $post->category_id) ? 'selected' : '' }}>{{$category->title}}</option>
      @endforeach
    </select>
    <br>
    <label for="mytag">Select Post Tags:</label>
    <select class="form-control" name="tag_id[]" id="mytag" multiple >
      @foreach ($tags as $tag)
      <option value="{{$tag->id}}"
        @foreach ($tags_post as $tag_post)
        @if ($tag->id == $tag_post->id)
        {{'selected="selected"'}}
        @endif 
      @endforeach>{{$tag->word}}</option>
      @endforeach
    </select>
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection