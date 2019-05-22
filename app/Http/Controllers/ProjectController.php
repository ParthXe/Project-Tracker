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

    public function create_project()
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

		return redirect()->route('projects')->with('success','Project Upload successfully');
	}

	public function edit_project($id)
    {
    	$project = DB::select('select * from projects where id = ?',[$id]);
                        //print_r($project);
                        //exit();
        return view('projects.edit',['projects'=>$project]);
    }

	public function show_project($id)
    {
    	$project = DB::select('select * from projects where id = ?',[$id]);
        return view('projects.show',['projects'=>$project]);
    }

   	public function update_project(Request $request,$id)
    {
        
        $project_name= $request['project_name'];
		$project_id= $request['project_id'];
		$project_type= $request['project_type'];
		$project_total_value= $request['project_value'];
		$project_start_date= $request['start_date'];
		$project_end_date= $request['end_date'];
		$project_duration= $request['duration'];
		$project_status= $request['project_status'];
		$project_created_by= $request['manager_name'];

		DB::update('update projects set project_id = ?,project_name=?,project_type=?,project_total_value=?,	project_start_date=?,project_end_date=?,project_duration=?,project_created_by=?,project_status=? where id = ?',[$project_id,$project_name,$project_type,$project_total_value,$project_start_date,$project_end_date,$project_duration,$project_created_by,$project_status, $id]);

		        return redirect()->route('projects')
                        ->with('success','Project updated successfully');
	}

   	public function destroy_project($id)
    {
        //DB::delete('delete from projects where id = ?',[$id]);

        $project = Project::find($id);
        $project->delete();
      	return redirect()->route('projects')->with('success','Project delete successfully');
    }
}
