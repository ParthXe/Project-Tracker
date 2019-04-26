<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use DB;
class ProjectController extends Controller
{
    
    public function projects()
    {
        $projects = DB::select('select * from projects');
		return view('projects.project_list',['projects'=>$projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

	public function save_data(Request $request)
	{     


		$this->validate(request(),[
		//put fields to be validated here
		]);         

		$project= new Project();
		$project->project_name= $request['project_name'];
		$project->project_id= $request['project_id'];
		$project->project_type= $request['project_type'];
		$project->project_total_value= $request['project_value'];
		$project->project_start_date= $request['start_date'];
		$project->project_end_date= $request['end_date'];
		$project->project_duration= $request['duration'];
		$project->project_status= $request['project_status'];
		$project->project_created_by= $request['manager_name'];
		// add other fields


		$project->save();

		return redirect('/home');
	}

	public function edit()
    {
        return view('projects.edit');
    }

	public function show()
    {
        return view('projects.show');
    }

   	public function update()
    {
        //return view('projects.create');
    }

   	public function delete()
    {
        //return view('projects.create');
    }
}
