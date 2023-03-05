@extends('dashboard.layout')
@section('content')

<form action="{{route('roles.update', $role->id)}}" method="post">
    @csrf 
    @method('PUT')
  <div class="row">
    <div class="col-md-6">
        <label for="">Enter Role Name:</label>
      <input type="text" class="form-control" 
      value="{{$role->name}}" name="name">
</div>
<div class="col-md-6">
<input type="submit" value="Add New Role" class="btn btn-primary mt-4">

</div>
  </div>
</form>

@endsection