@extends('layouts.app')
@section("title","edit tag")
@section("content")

 <h1 class="mt-5 mb-5">edit {{ $tag->word }} tag</h1>
 <form action="{{route('tags.update',$tag)}}" method="POST">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="word" placeholder="tag word" value="{{ $tag->word }}">
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection