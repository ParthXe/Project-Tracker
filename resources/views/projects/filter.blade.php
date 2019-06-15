@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Project List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create_project') }}"> Create New Project</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <script>
    $(document).ready(function()
                     {
        $("#fetchval").on('change',function()
                         {
            var keyword = $(this).val();
            $.ajax(
            {
                url:'fetch.php',
                type:'POST',
                data:'request='+keyword,

                beforeSend:function()
                {
                    $("#table-container").html('Working...');

                },
                success:function(data)
                {
                    $("#table-container").html(data);
                },
            });
        });
    });

</script>

    <form action="{{ route('filter_project') }}" method="POST">
    <select id="fetchval" name="fetchby" >
      <option value="Unassigned">Unassigned</option>
      <option value="Client to revert">Client to revert</option>
      <option value="Invoice raised/Waiting for payment">Invoice raised/Waiting for payment</option>
      <option value="In progress">In progress</option>
      <option value="On hold">On hold</option>
      <option value="Completed">Completed</option>
      <option value="Delivered">Delivered</option>
    </select>
    </form>
    <br>
    <br>
    <div id="table-container">

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

                        <a class="btn btn-info" href="{{ route('show_project',$project->id) }}">Show</a>



                        <a class="btn btn-primary" href="{{ route('edit_project',$project->id) }}">Edit</a>



                        <a class="btn btn-danger" href="{{ route('destroy_project',$project->id) }}">Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
      </div>
    </div>

@endsection
