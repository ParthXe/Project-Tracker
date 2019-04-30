<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        protected $fillable = [
		'project_id',
		'project_name',
		'project_type',
		'project_total_value',
		'project_start_date',
		'project_end_date',
		'project_duration',
		'project_created_by',
		'project_status'
          
          // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'projects';
}
