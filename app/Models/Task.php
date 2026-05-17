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

    function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    function user()
    {
        return $this->hasOne(User::class);
    }
}
