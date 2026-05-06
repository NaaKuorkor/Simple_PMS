<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tbltasks";
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'task_desc',
        'status',
        'createuser',
        'createdate',
        'modifyuser',
        'modifydate'
    ];
}
