@extends('layouts.app')
@section("title","show user")
@section("content")

  <div class="card mb-5 mt-5">
    <img src="/images/users/{{$user->image}}">
    <h1>name:{{$user->name}}</h1>
    <p>email:{{$user->email}}</p>
    <p>is admin: {{$user->is_admin}}</p>
    @if($user->status=='Active')
    <a href="{{URL::to('changeUserStatus/Blocked/'.$user->id)}}" class="btn btn-secondary mt-5 mb-5">Block</a>
    @else
    <a href="{{URL::to('changeUserStatus/Active/'.$user->id)}}" class="btn btn-success mt-5 mb-5">Un-Block</a>
    @endif
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