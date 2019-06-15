@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Project') }}</div>

                <div class="card-body">
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

                            <div class="col-md-6 wrapper">
                              <div class="col-md-12" style="float:left;padding:0!important;margin-bottom: 1%;">
                                    <div class="col-md-12" style="float:left;padding:0!important;">
                                      <span style="font-weight:800;margin-right:1%;float:left;">1.</span>
                                      <input type="text" class="form-control" style="width:60%!important;float:left;" name="scope[]">
                                      <select class="form-control" id="assign_department" style="width:30%!important;float:left;" name="assign_department[]">
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
    </div>
</div>
<script type="text/javascript">
  /*  $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});*/
$(document).ready(function(){
  var max_fields = 10;
    var wrapper = $(".wrapper");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            var html=`<div class="col-md-12" style="float:left;padding:0!important;">
            <span style="font-weight:800;margin-right:1%;float:left;">`+x+`</span>
            <input type="text" class="form-control" style="width:60%!important;float:left;" name="mytext[]"/>
            <select class="form-control" id="assign_department" style="width:30%!important;float:left;" name="assign_department[]">
                      <option value="">-Select HOD-</option>
                      <option value="Designer">Designer</option>
                      <option value="Programmer">Programmer</option>
                      <option value="IT">IT</option>
            </select>
            <button class="delete" style="background:#fde03c;color:red;font-weight:800;margin-left:1%;float:right;">
            <span style="font-size:16px; font-weight:bold;">X</span>
            </button>
            </div>`;
            $(wrapper).append(html); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
})
$("#project_po").change(function(){
  $("#project_po_file_name").text(this.files[0].name);
});
</script>
@endsection
