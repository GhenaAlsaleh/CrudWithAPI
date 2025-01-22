@extends('layouts.app')
@section("title","add tag")
@section("content")

 <h1 class="mt-5 mb-5">add new tag</h1>
 <form action="{{route('tags.store')}}" method="POST" >
    @csrf
    <input class="form-control" type="text" name="word" placeholder="enter tag word">
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection