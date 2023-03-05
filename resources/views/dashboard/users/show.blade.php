@extends('dashboard.layout')
@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Users Section</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('users.create')}}" class="btn btn-sm btn-outline-secondary">Add New User</a>
            </div>
        </div>
</div>
@if($user)

<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                
                <tr>
                  <th>#</th>
                  <th>Name</th>
                 <th>Thumbnail</th>
                  <th>City</th>
                  <th>Country</th>
                  <th>Roles</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td><img src="{{asset($user->profile->photo ?? 'dummy.jpg')}}" alt="" 
                    height="50" width="50"></td>
                    <td>{{$user->profile->city ?? "N/A" }}</td>
                    <td>{{$user->profile->country->name ?? "N/A"}}</td>
                    <td>
                    @if(!$user->roles->isEmpty())
                    {{$user->roles->implode('name', ', ')}}
                    @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                        <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
              <form action="{{route('users.destroy', $user->id)}}" method="POST">
                     @csrf 
                       @method('DELETE')
                     <button role="button" class="btn btn-link">DELETE</button>
                 </form>
         <a href="{{route('users.edit', $user->id)}}" role="button" class="btn btn-link">EDIT</a>
   </div>

                    </td>
                    
                </tr>

            </table>
          </div>
        </main>
      </div>
    </div>
    @else
    <p class="alert alert-info">No Users Found...</p>
    @endif
@endsection