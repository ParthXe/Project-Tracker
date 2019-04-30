@extends('layouts.admin')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Project List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create') }}"> Create New Project</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->project_type }}</td>
            <td>
                <form action="" method="POST">
   
                    <a class="btn btn-info" href="{{ route('show',$project->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('edit',$project->id) }}">Edit</a>
   

      
                    <a class="btn btn-danger" href="{{ route('destroy',$project->id) }}">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
      
@endsection
