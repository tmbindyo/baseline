<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function milestone()
    {
        return $this->belongsTo('App\Milestone');
    }
    public function assignee()
    {
        return $this->belongsTo('App\User', 'assignee_id', 'id');
    }
    public function taskList()
    {
        return $this->belongsTo('App\TaskList');
    }
    public function assignedTask()
    {
        return $this->belongsTo('App\User', 'assignee_id', 'id');
    }

    // Children
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
    public function timesheets()
    {
        return $this->hasMany('App\Timesheet');
    }
    public function taskUploads()
    {
        return $this->hasMany('App\TaskUpload');
    }
}
