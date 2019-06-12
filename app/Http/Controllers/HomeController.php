<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role=='admin' || Auth::user()->role=='HOD')
        {
            $project_name = DB::select('select * FROM projects');
        $task_list = DB::select('select projects.id as projectId, projects.project_name, task_list.id as taskList_id, task_list.task_name, task_list.task_description, task_list.assigned_user_id, task_list.created_at, users.id as userID, users.name FROM projects INNER JOIN task_list ON projects.id=task_list.project_id INNER JOIN users ON task_list.assigned_user_id=users.id');

        $data = [
            'projects'=> $project_name,
            'tasks'=>$task_list
        ];
        //return view('task.task_list',$data);
        return view('home',$data);    
        }
        elseif (Auth::user()->role=='Programmer' || Auth::user()->role=='admin') {
        $status_list = DB::select('select projects.project_name, projects.id, task_list.id, task_list.task_name, task_status.update_comment, task_status.task_status FROM task_list INNER JOIN projects ON projects.id=task_list.project_id INNER JOIN task_status ON task_list.id=task_status.task_id');

        $data = [

        'statuses'=>$status_list

        ];

        // print_r($data);
        // exit();
        return view('home',$data);
        }

        
    }

    public function test()
    {
        return view('test');
    }

    public function approval()
    {
       return view('approval');
    }

    public function role()
    {
       return view('role');
    }



}
