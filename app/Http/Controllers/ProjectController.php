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
		$project->active = ($request['active'] == "on") ? 1 : 0;
		// add other fields


		$project->save();

		return redirect()->route('projects')->with('success','Project Upload successfully');
	}

	public function edit_project($id)
    {
    	$project = DB::select('select * from projects where id = ?',[$id]);
                        // print_r($project);
                        // exit();
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
		$project_active = ($request['active'] == "on") ? 1 : 0;

		DB::update('update projects set project_id = ?,project_name=?,project_type=?,project_total_value=?,	project_start_date=?,project_end_date=?,project_duration=?,project_created_by=?,project_status=?,active=? where id = ?',[$project_id,$project_name,$project_type,$project_total_value,$project_start_date,$project_end_date,$project_duration,$project_created_by,$project_status,$project_active, $id]);

		        return redirect()->route('projects')
                        ->with('success','Project updated successfully');
	}

	public function filter_project(Request $request)
    {

    	//echo $request['message'];

   
	if($request['message']=='All')
	{
		$projects = DB::select('select * from projects');
    		 	$response = array(
          'status' => 'success',
          'projects' => $projects,
      );
				return response()->json($response);
	} 
	else
	{
	 	$projects = DB::select('select * from projects where project_status= ?', [$request->message]);
    		 	$response = array(
          'status' => 'success',
          'projects' => $projects,
      );
				return response()->json($response);
	}     
    	
  
    }

   	public function destroy_project($id)
    {
        //DB::delete('delete from projects where id = ?',[$id]);

        $project = Project::find($id);
        $project->delete();
      	return redirect()->route('projects')->with('success','Project delete successfully');
    }
}
