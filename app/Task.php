<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
		'project_id',
		'task_name',
		'task_description',
		'task_comments',
		'assigned_user_id',
		'created_by'

          // add all other fields
    ];

    protected $table = 'task_list';
}
