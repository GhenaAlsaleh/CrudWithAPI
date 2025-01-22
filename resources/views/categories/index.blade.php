@extends('layouts.app')
@section("title","categories")
@section("content")
<div class="row">
  <div class="col-md-8">
    <h1>Categories</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">image</th>
          <th scope="col">title</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <th><img style="width:50%" class="rounded float-start" src="/images/categories/{{$category->image_category}}"></th>
          <td>{{$category->title}}</td>
          <td><a href="{{route('categories.edit',$category)}}" class="btn btn-secondary mt-5 mb-5">edit category</a></td>
          <td><form method="POST" action="{{ route('categories.destroy', $category) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">delete category</button>
          </form></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 </div>
  @endsection