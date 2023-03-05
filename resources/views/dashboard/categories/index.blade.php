@extends('dashboard.layout')
@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Roles Section</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-secondary">Add New Roles</a>
            </div>
        </div>
</div>
@if(!$categories->isEmpty())

<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                
                <tr>
                  <th>#</th>
                  <th>Category Title</th>
                  <th>Thumbnail</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Children</th>
                  <th>Actions</th>
                </tr>
              </thead>
              @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td><img src="{{asset($category->thumbnail)}}" alt="" 
                    height="50" width="50"></td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                            <td>
                        @if(!$category->children->isEmpty())
                        @foreach($category->children as $child)
                        
                            {{$child->title}},

                        
                        @endforeach
                        @else
                          {{'Parent Category'}}
                        @endif
</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
       <a href="{{route('categories.show', $category->id)}}" role="button" 
       class="btn btn-link">VIEW</a>
              <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                     @csrf 
                       @method('DELETE')
                     <button role="button" class="btn btn-link">DELETE</button>
                 </form>
         <a href="{{route('categories.edit', $category->id)}}" role="button" class="btn btn-link">EDIT</a>
   </div>

                    </td>
                    
                </tr>
@endforeach
            </table>
          </div>
        </main>
      </div>
    </div>
    @else
    <p class="alert alert-info">No Categories Found...</p>
    @endif
@endsection