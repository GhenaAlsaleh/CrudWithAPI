@extends('layouts.app')
@section("title","posts")
@section("content")
<a href="{{route('posts.create')}}" class="btn btn-secondary mt-5 ">add new post</a>
<a href="{{URL::to('users/dashboard')}}" class="btn btn-secondary mt-5 ">dashboard</a>
<div class="container d-flex mt-5 mb-5 justify-content-evenly flex-wrap">
 @forelse($posts as $post)
  <div class="card mt-5 mb-5">
    @php 
    $user = $users->find($post->user_id);
    @endphp
    <div class="card-header">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="/images/users/{{$user->image}}" alt="Logo" width="30" height="24" class="rounded d-inline-block align-text-top">
          {{$user->name}}
        </a>
      </div>
    </div>
     <img style="width:100%" class="rounded float-start card-img-top" src="/images/posts/{{$post->image}}">
    <div class="card-body">
    <h1>{{$post->title}}</h1>
    <p>{{$post->description}}</p>
    @php 
    $category = $categories->find($post->category_id);
    @endphp

<div class="card border-light mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/images/categories/{{$category->image_category}}" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Category:</h5>
        <p class="card-text">{{$category->title}}</p>
        <p class="card-text"><small class="text-body-secondary">Created at:{{$category->created_at}} </small></p>
      </div>
    </div>
  </div>
</div>
    
    @php
    $tags_post=$post->tags;
    @endphp
<div class="card border-light" style="width: 18rem;">
  <div class="card-header">
    <strong>Tags</strong>
  </div>
  <ul class="list-group list-group-flush">
    @foreach ($tags_post as $tag_post)
    <li class="list-group-item">{{ $tag_post->word }}</li>
    @endforeach
  </ul>
</div>
    <a href="{{route('posts.show',$post)}}" class="btn btn-primary mt-5 ">show post</a>
    @can('sameUserpost',$post)
    <a href="{{route('posts.edit',$post)}}" class="btn btn-secondary mt-5 ">edit post</a>
    @endcan
    @can('sameUserpost',$post)
    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="btn btn-danger mt-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete post</button>
    </form>
   @endcan
  </div>
  </div>
  @empty
   <h1>there is no posts</h1>
  @endforelse
</div>
  @endsection