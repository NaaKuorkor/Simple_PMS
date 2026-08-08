<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected static function booted()
    {
        static::creating(function ($task) {
            $task->createdate = now();
            $task->createuser = Auth::user()?->email;
            $task->modifydate = now();
            $task->modifyuser = Auth::user()?->email;
        });

        static::updating(function ($task) {
            $task->modifyuser = Auth::user()?->email;
            $task->modifydate = now();
        });
    }
}
