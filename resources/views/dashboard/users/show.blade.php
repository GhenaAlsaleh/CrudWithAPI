@extends('layouts.app')
@section("title","show user")
@section("content")

  <div class="card mb-5 mt-5">
    <img src="/images/users/{{$user->image}}">
    <h1>name:{{$user->name}}</h1>
    <p>email:{{$user->email}}</p>
    <p>is admin: {{$user->is_admin}}</p>
    <a href="{{route('posts.index')}}" class="btn btn-primary mb-5 mt-5">main page</a>
    <a href="{{route('users.edit',$user)}}" class="btn btn-secondary mt-5 mb-5">edit user</a>
    @can('manageUser',Auth::user())
    <form method="POST" action="{{ route('users.destroy', $user) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete user</button>
    </form>
    @endcan
  </div>
  @endsection