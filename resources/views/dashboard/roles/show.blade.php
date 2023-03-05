@extends('dashboard.layout')
@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Roles Section</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('roles.create')}}" class="btn btn-sm 
                btn-outline-secondary">Add New Roles</a>
            </div>
        </div>
</div>
@if($role)

<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                
                <tr>
                  <th>#</th>
                  <th>Role Name</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tr>
              </thead>
             
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
              <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                     @csrf 
                       @method('DELETE')
                     <button role="button" class="btn btn-link">DELETE</button>
                 </form>
         <a href="{{route('roles.edit', $role->id)}}" role="button" class="btn btn-link">EDIT</a>
   </div>

                    </td>
                    
                </tr>

            </table>
          </div>
        </main>
      </div>
    </div>
    @else
    <p class="alert alert-info">No Roles Found...</p>
    @endif
@endsection