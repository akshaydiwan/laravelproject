@extends('dashboard.layout')
@section('content')

<form action="{{route('users.store')}}" method="post"
enctype='multipart/form-data'>
    @csrf 
  <div class="form-group">
    <label for="">Username</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Username" name="username">
   </div>
   <div class="form-group">
    <label for="">Full Name</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Name" name="name">
   </div>
   <div class="form-group">
   <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" 
    aria-describedby="emailHelp" placeholder="Enter email" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" 
    id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Address" name="address">
</div>
     <div class="form-group">
    <label for="">Phone</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Phone No" name="phone">

  <div class="form-group">
    <label for="">Select An Image:</label><br>
    <input type="file" id="" name="photo" class="form-control-file mt-2">
    
  </div>
  <div class="form-group">
    <label for="">Enter City</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Name" name="city">
   </div>
  <div class="form-group">
    <label for="">Select Country:</label><br>
    <select name="country" id="" class="form-select" >
        @if(!$countries->isEmpty())
        @foreach($countries as $country)
        <option value="{{$country->id}}">{{$country->name}}</option>
        @endforeach
        @endif
    </select>
  </div>
  <div class="form-group">
    <label for="">Select Roles:</label><br>
    <select name="roles[]" id="" class="form-select" multiple>
        
        @if(!$roles->isEmpty())
        @foreach($roles as $role)
        <option value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
        @endif
    </select>
  </div>
  
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

@endsection