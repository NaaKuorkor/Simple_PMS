<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $table = "tblprojects";
    public $timestamp = false;

    protected $fillable = [
        'project_id',
        'user_id',
        'project_title',
        'description',
        'start_date',
        'end_date',
        'status',
        'createuser',
        'createdate',
        'modifyuser',
        'modifydate'
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected static function booted()
    {
        static::updating(function ($project) {
            $project->modifyuser = Auth::user()?->email;
            $project->modifydate = now();
        });
    }
}
