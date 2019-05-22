<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task_status;
use DB;

class Task_Status_Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function task_status_list()
     {
        $status_list = DB::select('select * from task_status');
        return view('task.task_status_list',['statuses'=>$status_list]);
     }

     public function update_assigned_task(){
         $tasks = DB::select('select * from task_list');
         $users = DB::select('select * from users');
         return view('task.update_assigned_task',['tasks'=>$tasks],['users'=>$users]);
     }

     public function save_task_status(Request $request)
     {


       $this->validate(request(),[
       //put fields to be validated here
       ]);

       $task_status= new Task_status();
       $task_status->task_id= $request['task_id'];
       $task_status->update_comment= $request['task_comments'];
       $task_status->task_start_time= $request['Start_Time'];
       $task_status->task_end_time= $request['End_Time'];
       $task_status->task_status= $request['task_status'];
       // add other fields


       $task_status->save();

               return redirect()->route('task.update_assigned_task')
                           ->with('success','Task Status Updated Successfully');
     }
}
