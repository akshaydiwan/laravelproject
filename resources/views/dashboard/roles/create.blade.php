@extends('dashboard.layout')
@section('content')

<form action="{{route('roles.store')}}" method="post">
    @csrf 
  <div class="row">
    <div class="col-md-6">
        <label for="">Enter Role Name:</label>
      <input type="text" class="form-control" 
      placeholder="Role Name" name="name">
</div>
<div class="col-md-6">
<input type="submit" value="Add New Role" class="btn btn-primary mt-4">

</div>
  </div>
</form>

@endsection