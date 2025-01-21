@extends('layouts.app')
@section("title","categories")
@section("content")

 @forelse($categories as $category)
  <div class="card">
    <img style="width:50%" class="rounded float-start" src="/images/categories/{{$category->image_category}}">
    <h1>{{$category->title}}</h1>
    <a href="{{route('categories.edit',$category)}}" class="btn btn-secondary mt-5 mb-5">edit category</a>
    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete category</button>
    </form>
  </div>
  @empty
   <h1>there is no categories</h1>
  @endforelse
  @endsection