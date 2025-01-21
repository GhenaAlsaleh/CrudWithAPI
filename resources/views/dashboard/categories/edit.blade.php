@extends('layouts.app')
@section("title","edit category")
@section("content")

 <h1 class="mt-5 mb-5">edit {{ $category->title }} category</h1>
 <form action="{{route('categories.update',$category)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="title" placeholder="category title" value="{{ $category->title }}">
    <br>
    <input class="form-control" type="file" name="image_category" id="catimage">
    <lable for="catimage">
       <img src="/images/categories/{{$category->image_category}}">
      </lable>
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection