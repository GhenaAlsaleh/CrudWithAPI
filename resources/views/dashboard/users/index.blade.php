@extends('layouts.app')
@section("title","users")
@section("content")

 @forelse($users as $user)
  <div class="card">
    <div class="card-header">
    <figure>
    <img style="width:7%" class="rounded float-start" src="/images/users/{{$user->image}}">
    <h3>{{$user->name}}</h3>
    </div>
    <div class="card-body">
    <p><strong>email:     </strong>{{$user->email}}</p>
    <br>
    <p><strong>is admin:</strong> {{$user->is_admin}}</p>
  </figure>
    <a href="{{route('users.edit',$user)}}" class="btn btn-secondary mt-5 mb-5">edit user</a>
    <a href="{{route('users.show',$user)}}" class="btn btn-success mt-5 mb-5">show user</a>
    <form method="POST" action="{{ route('users.destroy', $user) }}" class="btn btn-danger mt-5 mb-5 pt-0 pb-0"> 
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">delete user</button>
    </form>
  </div>
</div>
  @empty
   <h1>there is no users</h1>
  @endforelse
  @endsection