@extends('layouts.admin')
 
@section('content')
   <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row custome_heading">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Task List</h2>

            </div>
<form class="form_project" action="" method="POST">
    <select id="fetchval" class="fetchval btn dropdown-toggle" name="fetchby" >
        <option class="dropdown-item" value="">Project Name</option>
        @foreach ($projects as $project)
        <option class="dropdown-item" value="{{ $project->project_name }}">{{ $project->project_name }}</option>
        @endforeach
    </select>
    </form>
            <div class="pull-right" style="line-height: 36px;">
                <a class="btn" style="background: #fde03c;color: #000;" href="{{ route('create') }}"> Create New Task</a>
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
             var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var keyword = $(this).val();
            //alert(keyword);
            $.ajax(
            {
                
                url:"{{ route('filter_task') }}",
                type:'POST',
                //data:'test='+keyword,
                //dataType: 'JSON',
                data: {_token: CSRF_TOKEN, message:$(".fetchval").val()},
                // beforeSend:function()
                // {
                     
                //     $("#table-container").html('Working...');
                    
                // },
                success:function(data)
                {
                    console.log(data);
                    var len=data.projects.length;
                    //alert(temp[0]['project_name']);
                    //$("#table-container").html(data);
                    var div = document.getElementById('table-container');
                    /*div.innerHTML += '<table class="table table-bordered">';
                    div.innerHTML += '<tr>';
                    div.innerHTML += '<th>No</th>';
                    div.innerHTML += '<th>Name</th>';
                    div.innerHTML += '<th>Details</th>';
                    div.innerHTML += '</tr>';

                    var len=data.projects.length;
                    for(var i=0;i<len;i++){
                        div.innerHTML += '<tr>';
                        div.innerHTML += '<td>'+data.projects[i].project_id+'</td>';
                        div.innerHTML += '<td>'+data.projects[i].project_name+'</td>';
                        div.innerHTML += '<td>'+data.projects[i].project_type+'</td>';
                        div.innerHTML += '</tr>';
                        //alert(data.projects[i].project_id+' '+data.projects[i].project_name);
                        //console.log(data.projects[i].project_name);
                    }
                    div.innerHTML += '</table>';*/
                    var j=1;
                    var div1=`<table class="table table-bordered">
                                 <tr>
                                    <th>No</th>
                                    <th>Project Name</th>
                                    <th>Task Name</th>
                                    <th>User Name</th>
                                    <th>Task_description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                 </tr>`;
                    for(var i=0;i<len;i++)
                    {

                        div1 +='<tr><td>'+j+'</td>';
                        div1 +='<td>'+data.projects[i].project_name+'</td>';
                        div1 +='<td>'+data.projects[i].task_name+'</td>';
                        div1 +='<td>'+data.projects[i].name+'</td>';
                        div1 +='<td>'+data.projects[i].task_description+'</td>';
                        div1 +='<td>'+data.projects[i].created_at+'</td>';
                        div1 +='<td><a class="btn" style="background:#009472;color:#fff" href="/show_task/'+data.projects[i].taskList_id+'">Show</a> <a class="btn btn-primary" href="/edit_task/'+data.projects[i].taskList_id+'">Edit</a> <a class="btn btn-danger" href="/delete_task/'+data.projects[i].taskList_id+'">X</a></td></tr>';
                        j++;
                    };
                    div1 +='</table>';
                    div.innerHTML=div1;
                   console.log(div1);
                },
            });
        });
    });
    
</script>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div id="table-container" style="padding: 10px 23px;">
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Project Name</th>
            <th>Task Name</th>
            <th>User Name</th>
            <th>Details</th>
            <th>Date</th>
            <th width="280px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $task->project_name }}</td>
            <td>{{ $task->task_name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ $task->task_description }}</td>
            <td>{{ $task->created_at }}</td>
            <td>
                <form action="" method="POST">
   
                    <a class="btn btn-info" href="{{ route('show',$task->taskList_id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('edit',$task->taskList_id) }}">Edit</a>
   

      
                    <a class="btn btn-danger" href="{{ route('destroy',$task->taskList_id) }}">X</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      </div>
@endsection
