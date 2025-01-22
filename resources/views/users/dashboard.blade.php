@extends('layouts.app')
@section("title","dashboard")
@section("content")
<div class="container">
<a href="{{route('users.index')}}" class="btn btn-secondary mt-5 mb-5">Users</a>
<a href="{{route('categories.index')}}" class="btn btn-secondary mt-5 mb-5">Categories</a>
<a href="{{route('tags.index')}}" class="btn btn-secondary mt-5 mb-5">Tags</a>
</div>
@endsection