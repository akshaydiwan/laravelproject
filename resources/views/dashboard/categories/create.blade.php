@extends('dashboard.layout')
@section('content')

<form action="{{route('categories.store')}}" method="post"
enctype='multipart/form-data'>
    @csrf 
  <div class="form-group">
    <label for="">Enter Title</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Title" name="title">
   </div>
   <div class="form-group">
    <label for="">Content</label>
    <textarea name="content" id="" cols="30" rows="5"
    class="form-control"></textarea>
   </div>
  <div class="form-group">
    <label for="">Select An Image:</label><br>
    <input type="file" id="" name="thumbnail" class="form-control-file mt-2">
    
  </div>
  <div class="form-group">
    <label for="">Select Category:</label><br>
    <select name="parent_id" id="" class="form-select" >
        <option value="0">Parent Category</option>
        @if(!$categories->isEmpty())
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
        @endif
    </select>
  </div>
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

@endsection