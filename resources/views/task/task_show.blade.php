@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update', $tasks[0]->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="task_name" class="col-md-4 col-form-label text-md-right">{{ __('Task Name') }}</label>

                            <div class="col-md-6">
                                <input id="task_name" type="text" class="form-control @error('task_name') is-invalid @enderror" name="task_name" value="{{ $tasks[0]->task_name }}" required autocomplete="name">

                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Project List') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="project_id" name="project_id">
                                    <option value="{{ $tasks[0]->project_id }}" {{ ( $tasks[0]->project_id == $tasks[0]->project_id ) ? 'selected' : '' }}>{{ $pname[0]->project_name }}</option>
                                @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="task_description" class="col-md-4 col-form-label text-md-right">{{ __('Task Description') }}</label>

                            <div class="col-md-6">
                            <textarea class="form-control" style="height:150px" name="task_description" placeholder="Detail">{{ $tasks[0]->task_description }}</textarea>
                              @error('department')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="task_comments" class="col-md-4 col-form-label text-md-right">{{ __('Task Comments') }}</label>

                            <div class="col-md-6">
                            <textarea class="form-control" style="height:150px" name="task_comments" placeholder="Detail">{{ $tasks[0]->task_comments }}</textarea>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Assinged User') }}</label>

                            <div class="col-md-6 input-group date">
                                <select class="form-control" id="user_id" name="user_id">
                                <option value="{{ $tasks[0]->assigned_user_id }}" {{ ( $tasks[0]->assigned_user_id == $tasks[0]->assigned_user_id ) ? 'selected' : '' }}>{{ $uname[0]->name }}</option>
                                @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                              </select>

                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group row">
                            <label for="manager_name" class="col-md-4 col-form-label text-md-right">{{ __('Project Created By') }}</label>

                            <div class="col-md-6">
                                <input id="manager_name" type="text" class="form-control @error('manager_name') is-invalid @enderror" name="manager_name" value="{{Auth::user()->name}}" required autofocus>

                                @error('manager_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-primary" href="{{ route('task') }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
</script>
@endsection
