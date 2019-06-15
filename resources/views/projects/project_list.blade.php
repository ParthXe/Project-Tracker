@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row custome_heading">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Project List</h2>

            </div>
<form class="form_project" action="" method="POST">
    <select id="fetchval" class="fetchval btn dropdown-toggle" name="fetchby" >
        <option class="dropdown-item" value="In Progress">In Progress</option>
        <option class="dropdown-item" value="Complete">Complete</option>
        <option class="dropdown-item" value="Re Open">Re Open</option>
        <option class="dropdown-item" value="On Hold">On Hold</option>
    </select>
    </form>
            <div class="pull-right" style="line-height: 36px;">
                <a class="btn" style="background: #fde03c;color: #000;" href="{{ route('create_project') }}"> Create New Project</a>
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

                url:"{{ route('filter_project') }}",
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
                    var div1=`<table class="table table-bordered" >
                                 <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Project Type</th>
                                    <th>Action</th>
                                 </tr>`;
                    for(var i=0;i<len;i++)
                    {
                        div1 +='<tr><td>'+j+'</td>';
                        div1 +='<td>'+data.projects[i].project_name+'</td>';
                        div1 +='<td>'+data.projects[i].project_type+'</td>';
                        div1 +='<td><a class="btn" style="background:#009472;color:#fff" href="/show_project/'+data.projects[i].id+'">Show</a> <a class="btn btn-primary" href="/edit_project/'+data.projects[i].id+'">Edit</a> <a class="btn btn-danger" href="/destroy_project/'+data.projects[i].id+'">X</a></td></tr>';
                        j++;
                    };
                    div1 +='</table>';
                    div.innerHTML=div1;
                   // console.log(div1);
                },
            });
        });
    });

</script>

    <div id="table-container" style="padding: 10px 23px;">
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Project Type</th>
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

                    <a class="btn" style="background:#009472;color:#fff" href="{{ route('show_project',$project->id) }}">Show</a>



                    <a class="btn btn-primary" href="{{ route('edit_project',$project->id) }}">Edit</a>



                    <a class="btn btn-danger" href="{{ route('destroy_project',$project->id) }}">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>

@endsection
