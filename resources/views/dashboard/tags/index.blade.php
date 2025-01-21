@extends('layouts.app')
@section("title","tags")
@section("content")

 <div class="row">
  <div class="col-md-8">
    <h1>Tags</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Word</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tags as $tag)
        <tr>
          <th>{{$tag->id}}</th>
          <td>{{ $tag->word }}</td>
          <td><a href="{{route('tags.show',$tag)}}"class="btn btn-primary">show tag</a></td>
          <td><a href="{{route('tags.edit',$tag)}}"class="btn btn-success">edit tag</a></td>
          <td><form method="POST" action="{{ route('tags.destroy', $tag) }}" class=""> 
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">delete tag</button>
          </form></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 </div>
  @endsection