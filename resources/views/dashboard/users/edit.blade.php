@extends('dashboard.layout')
@section('content')

<form action="{{route('users.update', $user->id)}}" method="post"
enctype='multipart/form-data'>

    @csrf 
    @method('PUT')
  
   <div class="form-group">
    <label for="">Enter Full Name</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Name" name="name"
     value="{{$user->name}}">
   </div>
   <div class="form-group">
   <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control mb-1" id="exampleInputEmail1" 
    aria-describedby="emailHelp" placeholder="Enter email" 
    name="email" value="{{$user->email}}">
  </div>
  <div class="form-group">
    
    <img src="{{asset($user->profile->photo)}}" alt="" width="100"
    height="100"><br>
    <label for="">Select An Image:</label><br>
    <input type="file" id="" name="photo" 
    class="form-control-file mt-2"> 
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Address" name="address" value="{{$user->profile->address}}">
</div>
<div class="form-group">
    <label for="">Phone</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Phone" name="phone" value="{{$user->profile->phone}}">
</div>
  <div class="form-group">
    <label for="">Enter City</label>
    <input type="text" class="form-control" id="" 
     placeholder="Enter Name" name="city" value="{{$user->profile->city}}">
   </div>
  <div class="form-group">
    <label for="">Select Country:</label><br>
    <select name="country" id="" class="form-select" >
        @if(!$countries->isEmpty())
        @foreach($countries as $country)
        <option 
       @if($country->id === $user->profile->country->id)
       {{'selected'}}
       @endif
        value="{{$country->id}}">{{$country->name}}</option>
       
        @endforeach
        @endif
    </select>
  </div>
  <div class="form-group">
    <label for="">Select Roles:</label><br>
    <select name="roles[]" id="" class="form-select" multiple>
        
        @if(!$roles->isEmpty())
        @foreach($roles as $role)
        <option 
        @if(in_array($role->id, $user->roles->pluck('id')->toArray()))
            {{'selected'}}
        @endif
        value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
        @endif
    </select>
  </div>
  
  <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>

@endsection