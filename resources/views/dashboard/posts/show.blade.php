@extends('dashboard.layout')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Post Section</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="{{route('posts.create')}}" class="btn btn-sm btn-outline-secondary">Add New Post</a>
              </div>
            </div>
          </div>
          @if($post)
          <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Thumbnail</th>
              <th scope="col">Slug</th>
              <th scope="col">Categories</th>
              <th scope="col">Created At</th>
              <th scope="col">Updated At</th>
              <th scope="col">Actions</th>

            </tr>
            </thead>
            <tbody>
              
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td><img src="{{asset($post->thumbnail)}}" 
                    alt="" width="50" height="50"></td>
                    <td>{{$post->slug}}</td>
                    <td>
                        @if(!$post->categories->isEmpty())
                        @foreach($post->categories as $cats)
                        {{$cats->title}},
                        @endforeach
                        @endif
                    </td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
      
              <form action="{{route('posts.destroy', $post->id)}}" 
              method="POST">
                     @csrf 
                       @method('DELETE')
                     <button role="button" class="btn btn-link">DELETE</button>
                 </form>
         <a href="{{route('posts.edit', $post->id)}}" role="button" class="btn btn-link">EDIT</a>
   </div>
                    </td>
                </tr>
             
            </tbody>
         
@else
    <p class="alert alert-info">No Posts Found....</p>
    @endif
@endsection