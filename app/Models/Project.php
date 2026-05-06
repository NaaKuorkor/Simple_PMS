<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "tblprojects";
    public $timestamp = false;

    protected $fillable = [
        'project_id',
        'userid',
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
}
