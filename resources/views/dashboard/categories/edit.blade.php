@extends('dashboard.layout')
@section('content')

<form action="{{route('categories.update', $category->id)}}" method="post"
enctype='multipart/form-data'>
    @csrf 
    @method('PUT')
  <div class="form-group">
    <label for="">Enter Title</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Title" name="title" value="{{$category->title}}">
   </div>
   <div class="form-group">
    <label for="">Content</label>
    <textarea name="content" id="" cols="30" rows="5"
    class="form-control mb-1">{{$category->content}}</textarea>
   </div>
  <div class="form-group">
   
    <img src="{{asset($category->thumbnail)}}" alt="" 
                  width="50" height="50">

                  <br>
                    <label for="">Select An Image:</label><br>
    <input type="file" id="" name="thumbnail" class="form-control-file mt-2">
    
  </div>
  <div class="form-group">
    <label for="">Select Category:</label><br>
    <select name="parent_id" id="" class="form-select" >
        <option value="0">Parent Category</option>
        @if(!$categories->isEmpty())
        @foreach($categories as $cats)
        <option 
        @if($category->parent->id === $cats->id)
        {{'selected'}}
        value="{{$cats->id}}">{{$cats->title}}
        @endif
    </option>
        @endforeach
        @endif
    </select>
  </div>
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

@endsection