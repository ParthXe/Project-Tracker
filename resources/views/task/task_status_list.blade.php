@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create') }}"> Create New Task</a>
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
            <th>Task ID</th>
            <th>Task Status</th>
            <th width="250px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($statuses as $status)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $status->task_id }}</td>
            <td>{{ $status->task_status }}</td>
            <td>
                <form action="" method="POST">


                </form>
            </td>
        </tr>
        @endforeach
    </table>


@endsection
