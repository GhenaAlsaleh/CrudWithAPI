@extends('layouts.app')
@section("title","show category")
@section("content")

  <div class="card mb-5 mt-5">
    <img src="/images/categories/{{$category->image_category}}">
    <h1>title:{{$category->title}}</h1>
    <a href="{{route('categories.index')}}" class="btn btn-primary mb-5 mt-5">main page</a>
    <a href="{{route('categories.edit',$category)}}" class="btn btn-secondary mt-5 mb-5">edit category</a>
    @can('manageUser',Auth::user())
    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete category</button>
    </form>
    @endcan
  </div>
  @endsection