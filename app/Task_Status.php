<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Status extends Model
{
    //
    protected $fillable = [
		'task_id',
		'update_comment',
		'task_start_time',
		'task_end_time',
		'task_status'
  ];

  protected $table = 'task_status';
}
