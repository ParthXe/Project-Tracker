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
      <option value="All">Unassigned</option>
      <option value="Client to revert">Client to revert</option>
      <option value="Invoice raised/Waiting for payment">Invoice raised/Waiting for payment</option>
      <option value="In progress">In progress</option>
      <option value="On hold">On hold</option>
      <option value="Completed">Completed</option>
      <option value="Delivered">Delivered</option>
    </select>
    </form>
            <div class="pull-right" style="line-height: 36px;">
                <a class="btn" style="background: #fde03c;color: #000;" href="#popup2"> Create New Project</a>
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
                    var name;
                    var name1;
                    var div1=`<table class="table table-bordered" >
                                 <tr>
                                    <th>No</th>
                                    <th>Project Name</th>
                                    <th>Project Type</th>
                                    <th>Status</th>
                                 </tr>`;
                    for(var i=0;i<len;i++)
                    { 
                        name = data.projects[i].project_status;
                        if(name=='In progress')
                        {
                            name1 ='<span style="color:#FFA500">'+name+'</span>';
                        }
                        else if(name=='Client to revert')
                        {
                            name1 ='<span style="color:#0d77fb">'+name+'</span>';
                        }
                        else if(name=='Completed')
                        {
                            name1 ='<span style="color:#00820f">'+name+'</span>';
                        }
                        else 
                        {
                            name1 ='<span style="color:#000">'+name+'</span>';
                        }   
                        div1 +='<tr><td>'+j+'</td>';
                        div1 +='<td>'+data.projects[i].project_name+'</td>';
                        div1 +='<td>'+data.projects[i].project_type+'</td>';
                        div1 +='<td>'+name1+'<a style="float:right;margin:3px;" class="btn btn-danger" href="/destroy_project/'+data.projects[i].id+'">X</a> <a class="btn" style="background:#009472;color:#fff;float:right;margin:3px;" href="/show_project/'+data.projects[i].id+'">Show</a> </td></tr>';
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
            <th>Project Name</th>
            <th>Project Type</th>
            <th width="280px">Status</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->project_type }}</td>
            <td>
                <p style="display: inline-block;">@if ($project->project_status == 'In progress')<span style="color:#ff5a00"> {{ $project->project_status }}</span> @elseif($project->project_status == 'Client to revert')<span style="color:#0d77fb"> {{ $project->project_status }}</span>@elseif($project->project_status == 'Completed')<span style="color:#00820f"> {{ $project->project_status }}</span>@else{{$project->project_status}}@endif
                <form style="display: inline-block;float: right;" action="" method="POST">
   
                    <a class="btn" style="background:#009472;color:#fff"  href="#popup1" onclick="myFunction({{ $project->id }});">Show</a>   

      
                    <a class="btn btn-danger" href="{{ route('destroy_project',$project->id) }}">X</a>
                </form></p>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>
  <div id="popup2" class="overlay">
    <div class="popup">
        <h2>Create New Project</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
                                <form method="POST" action="{{ route('save_project') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="project_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name" value="{{ old('project_name') }}" required autocomplete="name" autofocus>

                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('P.O No. / W.O No.') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-10" style="float:left;padding:0!important;">
                                <input id="project_id" type="text" class="form-control @error('name') is-invalid @enderror" name="project_id" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                                <div class="col-md-2" style="float:right;padding:0!important">
                                <label for="project_po" class="custom-file-upload" style="margin-bottom: 0!important;width: 40px;height: 40px;cursor: pointer;display: inline-block;background-image: url({{ asset('dist/img/Attachment_Button.png')}});">
                                <input id="project_po" style="display:none;" type="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" class="form-control @error('name') is-invalid @enderror" name="project_po" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                                <p id="project_po_file_name" name="" value="" style="background:transparent;color:#fde03c;font-weight:900;border-color:transparent;line-height:1.2rem"/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="project_type" name="project_type">
                                        <option value="Event">Event</option>
                                        <option value="Digital Transformation">Digital Transformation</option>
                                        <option value="Experience Center">Experience Center</option>
                              </select>
                              @error('department')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_value" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                            <div class="col-md-6">
                                <input id="project_value" type="text" class="form-control @error('password') is-invalid @enderror" name="project_value" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start date') }}</label>

                            <div class="col-md-6 input-group date" data-provide="datepicker">
                            <input name="start_date" type="text" class="form-control">
                            <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                            </div>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End date') }}</label>

                            <div class="col-md-6 input-group date" data-provide="datepicker">
                                <input name="end_date" type="text" class="form-control">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autofocus>

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="project_status" name="project_status">
                                        <option value="Unassigned">Unassigned</option>
                                        <option value="Client to revert">Client to revert</option>
                                        <option value="Invoice raised/Waiting for payment">Invoice raised/Waiting for payment</option>
                                        <option value="In progress">In progress</option>
                                        <option value="On hold">On hold</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Delivered">Delivered</option>
                              </select>

                                @error('project_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manager_name" class="col-md-4 col-form-label text-md-right">{{ __('Created By') }}</label>

                            <div class="col-md-6">
                                <input id="manager_name" type="text" class="form-control @error('manager_name') is-invalid @enderror" name="manager_name" value="{{Auth::user()->name}}" readonly>

                                @error('manager_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scope[]" class="col-md-4 col-form-label text-md-right">{{ __('Scope') }}</label>

                            <div class="col-md-6">
                              <div class="col-md-12" id="wrapper" style="float:left;padding:0!important;margin-bottom: 1%;">
                                      <span style="font-weight:800;margin-right:1%;float:left;">1.</span>
                                      <input type="text" class="form-control" style="width:60%!important;float:left;" id="scope1" name="scope1">
                                      <select class="form-control" id="assign_department1" style="width:30%!important;float:left;" name="assign_department1">
                                                <option value="">-Select HOD-</option>
                                                <option value="Designer">Designer</option>
                                                <option value="Programmer">Programmer</option>
                                                <option value="IT">IT</option>
                                      </select>
                                        <button class="add_form_field" style="float:right;background:#fde03c;">
                                            <span style="font-size:16px; font-weight:bold;">+ </span>
                                        </button>
                                        @error('scope[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="manager_name" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6">
                                <label class="container1">
                                <input type="checkbox" name="active">
                                <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn" style="background:#fde03c;color:#000">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
<div id="popup1" class="overlay">
    <div class="popup1">
       <a class="close" href="#">&times;</a>
        <div id="test" class="content">
            Thank to pop me out of that button, but now i'm done so you can close this window.
        </div>
    </div>
</div>
@endsection
<script>
function myFunction(page)
{
$.ajax({
  url: "show_project/"+page,
  type: "GET", //send it through get method
  success: function(response) {
    var mydiv;
    mydiv = document.getElementById('test');
    mydiv.innerHTML=response;
    console.log(response);
  },
  error: function(xhr) {
    //Do Something to handle error
  }
}); 
}
</script>