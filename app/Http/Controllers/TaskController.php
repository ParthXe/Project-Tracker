<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;

class TaskController extends Controller
{
     public function task()
    {
    	$project_name = DB::select('select * FROM projects');
        $task_list = DB::select('select projects.id as projectId, projects.project_name, task_list.id as taskList_id, task_list.task_name, task_list.task_description, task_list.assigned_user_id, task_list.created_at, users.id as userID, users.name FROM projects INNER JOIN task_list ON projects.id=task_list.project_id INNER JOIN users ON task_list.assigned_user_id=users.id');

        $data = [
			'projects'=> $project_name,
			'tasks'=>$task_list
		];
		return view('task.task_list',$data);
    }

    public function create()
    {
    	$projects = DB::select('select * from projects');
    	$users = DB::select('select * from users');
        return view('task.task_create',['projects'=>$projects],['users'=>$users]);
    }

	public function save_data(Request $request)
	{


		$this->validate(request(),[
		//put fields to be validated here
		]);

		$task= new Task();
		$task->project_id= $request['project_id'];
		$task->task_name= $request['task_name'];
		$task->task_description= $request['task_description'];
		$task->task_comments= $request['task_comments'];
		$task->assigned_user_id= $request['user_id'];
		$task->created_by= $request['manager_name'];
		$task->active = ($request['active'] == "on") ? 1 : 0;
		// add other fields


		$task->save();

		        return redirect()->route('task')
                        ->with('success','Task list create successfully');
	}

	public function edit($id)
    {
    	$projects = DB::select('select * from projects');
    	$users = DB::select('select * from users');
    	$task_list = DB::select('select * from task_list where id = ?',[$id]);
    	foreach ($task_list as $row) {
    		$pid = $row->project_id;
    		$uid = $row->assigned_user_id;
 		}
 		//echo $uid;

		$projects_name = DB::select('select project_name from projects where id = ?',[$pid]);
		$user_name = DB::select('select name from users where id = ?',[$uid]);
		//print_r($user_name);
		//exit();
    	//print_r($task_list[0]);
    	//exit();

		$data = [
			'users'=>  $users,
			'projects'=> $projects,
			'tasks'=>$task_list,
			'pname'=>$projects_name,
			'uname'=>$user_name
		];

        return view('task.task_edit', $data);

    }

	public function show($id)
    {
    	$projects = DB::select('select * from projects');
    	$users = DB::select('select * from users');
    	$task_list = DB::select('select * from task_list where id = ?',[$id]);
    	foreach ($task_list as $row) {
    		$pid = $row->project_id;
    		$uid = $row->assigned_user_id;
 		}
 		//echo $uid;

		$projects_name = DB::select('select project_name from projects where id = ?',[$pid]);
		$user_name = DB::select('select name from users where id = ?',[$uid]);
		//print_r($user_name);
		//exit();
    	//print_r($task_list[0]);
    	//exit();

		$data = [
			'users'=>  $users,
			'projects'=> $projects,
			'tasks'=>$task_list,
			'pname'=>$projects_name,
			'uname'=>$user_name
		];

        return view('task.task_show', $data);
     //    return view('task.show',['projects'=>$project]);
    }

   	public function update(Request $request,$id)
    {

    $task_name= $request['task_name'];
		$project_id= $request['project_id'];
		$task_description= $request['task_description'];
		$task_comments= $request['task_comments'];
		$assigned_user_id= $request['user_id'];
		$created_by= $request['manager_name'];
		$task_active = ($request['active'] == "on") ? 1 : 0;

		DB::update('update task_list set project_id = ?,task_name=?,task_description=?,task_comments=?, assigned_user_id=?, created_by=?, active=? where id = ?',[$project_id,$task_name,$task_description,$task_comments,$assigned_user_id,$created_by,$task_active, $id]);

		        return redirect()->route('task')
                        ->with('success','Task list updated successfully');
	}

   	public function destroy($id)
    {
        DB::delete('delete from task_list where id = ?',[$id]);

        $project = Project::find($id);
        $project->delete();
      	return redirect()->route('task')->with('success','Task delete successfully');
    }

    public function status()
    {
      $task_list = DB::select('select * from task_status');
      return view('task.task_list',['tasks'=>$task_list]);
    }


    public function filter_task(Request $request)
    {

    	//echo $request['message'];

   
      
    		$projects = DB::select('select projects.id as projectId, projects.project_name, task_list.id as taskList_id, task_list.task_name, task_list.task_description, task_list.assigned_user_id, task_list.created_at, users.id as userID, users.name FROM projects INNER JOIN task_list ON projects.id=task_list.project_id INNER JOIN users ON task_list.assigned_user_id=users.id where projects.project_name= ?', [$request->message]);
    		 	$response = array(
          'status' => 'success',
          'projects' => $projects,
      );
				return response()->json($response);
  
    }


}
