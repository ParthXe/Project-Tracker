@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Status Update') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save_task_status') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="task" class="col-md-4 col-form-label text-md-right">{{ __('Task Name') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="task_id" name="task_id">
                                @foreach ($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->task_name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">Time</label>
                            <div class="col-md-6 layout-slider">
                                <input id="Slider5" type="text" name="area" value="675;720"/>
                                <input id="Start_Time" type="hidden" name="Start_Time" value=""/>
                                <input id="End_Time" type="hidden" name="End_Time" value=""/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="task_comments" class="col-md-4 col-form-label text-md-right">{{ __('Task Comments') }}</label>

                            <div class="col-md-6">
                            <textarea class="form-control" style="height:150px" name="task_comments" placeholder="Detail"></textarea>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Task Status') }}</label>

                            <div class="col-md-6">
                              <select class="form-control" id="task_status" name="task_status">
                                        <option value="On Process">On Process</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Re-open">Re-open</option>
                                        <option value="On Hold">On Hold</option>
                              </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="manager_name" class="col-md-4 col-form-label text-md-right">{{ __('Task Created By') }}</label>

                            <div class="col-md-6">
                                @foreach ($tasks as $task)
                                  <input id="manager_name" type="text" class="form-control @error('manager_name') is-invalid @enderror" name="manager_name" value="{{ $task->created_by }}" readonly>
                                @endforeach
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
<script type="text/javascript" charset="utf-8">
        function calculateTime(value){
          var hours = Math.floor(parseInt(value) / 60);
          var mins = (parseInt(value)-hours * 60);
          var time=(hours < 10 ? "0" + hours : hours) + ":" + ( mins == 0 ? "00" : mins );
          return time;
        }
       $("#Slider5").slider({
         from: 600,
         to: 1140,
         step: 15,
         dimension: '',
         scale: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'],
         limits: false,
         calculate: function(value)
         {
            var hours = Math.floor(value / 60);
            var mins = ( value - hours * 60 );
            return (hours < 10 ? "0" + hours : hours) + ":" + ( mins == 0 ? "00" : mins );
         },
         onstatechange: function(value){
           //console.log(value+' ' +typeof(value));
           var time = value.split(';', 2);
           var start=time[0];
           var end=time[1];
           var start_time=calculateTime(start);
           var end_time=calculateTime(end);
           //var Worked_Time=start_time+'-'+end_time;
           document.getElementById("Start_Time").value = start_time;
           document.getElementById("End_Time").value = end_time;

         }
       });
</script>
@endsection
