@extends('layouts.app')
@section("title","add category")
@section("content")

 <h1 class="mt-5 mb-5">add new category</h1>
 <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input class="form-control" type="text" name="title" placeholder="enter category title">
    <br>
    <input class="form-control" type="file" name="image_category">
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection