@extends('layouts.app')
@section("title","edit user")
@section("content")

 <h1 class="mt-5 mb-5">edit {{ $user->name }} user</h1>
 <a href="{{route('users.change-password',$user)}}" class="btn btn-secondary mt-5 mb-5">Change Password</a>
 <form action="{{route('users.update',$user)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input class="form-control" type="text" name="name" placeholder="user name" value="{{ $user->name }}">
    <br>
    <input class="form-control" type="text" name="email" placeholder="user email" value="{{ $user->email }}">
    <br>
    <input class="form-control" type="file" name="image" id="imageu">
    <lable for="imageu">
       <img src="/images/users/{{$user->image}}">
      </lable>
    <br>
    <input type="submit" value="send" class="btn btn-secondary mt-5">
 </form>
 @endsection