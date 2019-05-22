@extends('layouts.admin')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Project {{ $projects[0]->project_name }}</h2>
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
   
         <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_project', $projects[0]->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="project_name" class="col-md-4 col-form-label text-md-right">{{ __('Project Name') }}</label>

                            <div class="col-md-6">
                                <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name" value="{{ $projects[0]->project_name }}" required autocomplete="name">
                                <input id="projects_sl" type="hidden" class="form-control @error('project_name') is-invalid @enderror" name="id" value="{{ $projects[0]->id }}">
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Project Id') }}</label>

                            <div class="col-md-6">
                                <input id="project_id" type="text" class="form-control @error('name') is-invalid @enderror" name="project_id" value="{{ $projects[0]->project_id }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_type" class="col-md-4 col-form-label text-md-right">{{ __('Project Type') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="project_type" name="project_type">
                                        <option value="{{ $projects[0]->project_type }}" {{ ( $projects[0]->project_type == $projects[0]->project_type ) ? 'selected' : '' }}>{{ $projects[0]->project_type }}</option>
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
                            <label for="project_value" class="col-md-4 col-form-label text-md-right">{{ __('Project value') }}</label>

                            <div class="col-md-6">
                                <input id="project_value" type="text" class="form-control @error('password') is-invalid @enderror" name="project_value" value="{{ $projects[0]->project_total_value }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Project start date') }}</label>

                            <div class="col-md-6 input-group date" data-provide="datepicker">
                            <input name="start_date" type="text" class="form-control" value="{{ $projects[0]->project_start_date }}">
                            <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                            </div>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Project end date') }}</label>

                            <div class="col-md-6 input-group date" data-provide="datepicker">
                                <input name="end_date" type="text" class="form-control" value="{{ $projects[0]->project_end_date }}">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Project Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ $projects[0]->project_duration }}" required>

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_status" class="col-md-4 col-form-label text-md-right">{{ __('Project Status') }}</label>

                            <div class="col-md-6">
                             <select class="form-control" id="project_status" name="project_status">
                                <option value="{{ $projects[0]->project_status }}" {{ ( $projects[0]->project_status == $projects[0]->project_status ) ? 'selected' : '' }}>{{ $projects[0]->project_status }}</option>
                                        <option value="In progress">In progress</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Re-open">Re-open</option>
                                        <option value="On hold">On hold</option>
                              </select>


                                @error('project_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manager_name" class="col-md-4 col-form-label text-md-right">{{ __('Project Created By') }}</label>

                            <div class="col-md-6">
                                <input id="manager_name" type="text" class="form-control @error('manager_name') is-invalid @enderror" name="manager_name" value="{{ $projects[0]->  project_created_by }}" required>

                                @error('manager_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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

  
      
@endsection
