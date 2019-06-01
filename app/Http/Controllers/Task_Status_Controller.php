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
     public function task_status()
     {
        $status_list = DB::select('select projects.project_name, projects.id, task_list.id, task_list.task_name, task_status.update_comment, task_status.task_status FROM task_list INNER JOIN projects ON projects.id=task_list.project_id INNER JOIN task_status ON task_list.id=task_status.task_id');

        $data = [

        'statuses'=>$status_list

        ];

        // print_r($data);
        // exit();
        return view('task.task_status',$data);
     }

     public function assigned_task(){
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

               return redirect()->route('task_status')
                           ->with('success','Task Status Updated Successfully');
     }

      public function edit_task_status($id)
    {
        
          $task_list = DB::select('select * from task_status where id = ?',[$id]);
          foreach ($task_list as $row) {
          $pid = $row->task_id;
         // $uid = $row->assigned_user_id;
        }
        //echo $uid;

        $task_name = DB::select('select task_name from task_list where id = ?',[$pid]);
       // $user_name = DB::select('select name from users where id = ?',[$uid]);
        //print_r($user_name);
        //exit();
        //print_r($task_list[0]);
        //exit();

        $data = [

          'tasks'=>$task_list,
          'tname'=>$task_name

        ];


        return view('task.edit_task_status', $data);

    }


    public function update_assigned_task(Request $request,$id)
    {

      $task_id= $request['task_id'];
      $update_comment= $request['task_comments'];
      $Start_Time= $request['Start_Time'];
      $End_Time= $request['End_Time'];
      $task_status= $request['task_status'];
      

      DB::update('update task_status set task_id = ?,update_comment=?,task_start_time=?,task_end_time=?, task_status=? where id = ?',[$task_id,$update_comment,$Start_Time,$End_Time,$task_status, $id]);

             return redirect()->route('task_status')
                             ->with('success','Task Status Updated Successfully');
      }

      public function show_task_status($id)
      {

        $task_list = DB::select('select * from task_status where id = ?',[$id]);
              foreach ($task_list as $row) {
              $pid = $row->task_id;
             // $uid = $row->assigned_user_id;
            }
            //echo $uid;

            $task_name = DB::select('select task_name from task_list where id = ?',[$pid]);
           // $user_name = DB::select('select name from users where id = ?',[$uid]);
            //print_r($user_name);
            //exit();
            //print_r($task_list[0]);
            //exit();

            $data = [

              'tasks'=>$task_list,
              'tname'=>$task_name

            ];


            return view('task.show_task_status', $data); 
      }

      public function destroy_status($id)
    {
        DB::delete('delete from task_status where id = ?',[$id]);

        
        return redirect()->route('task_status')->with('success','Task delete successfully');
    }

      public function filter_status(Request $request)
    {

      //echo $request['message'];

   
      
        $projects = DB::select('select projects.project_name, projects.id, task_list.id, task_list.task_name, task_status.update_comment, task_status.task_status FROM task_list INNER JOIN projects ON projects.id=task_list.project_id INNER JOIN task_status ON task_list.id=task_status.task_id where task_status.task_status= ?', [$request->message]);
          $response = array(
          'status' => 'success',
          'projects' => $projects,
      );
        return response()->json($response);
  
    }

}
