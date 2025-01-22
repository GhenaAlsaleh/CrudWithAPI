@extends('layouts.app')
@section("title","show tag")
@section("content")

  <div class="card mb-5 mt-5">
    <h1>tag word:{{$tag->word}}</h1>
    
    <a href="{{route('tags.edit',$tag)}}" class="btn btn-secondary mt-5 mb-5">edit tag</a>
  
    <form method="POST" action="{{ route('tags.destroy', $tag) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete tag</button>
    </form>
 
  </div>
  <a href="{{route('tags.index')}}" class="btn btn-primary mb-5 mt-5">main page</a>
  @endsection