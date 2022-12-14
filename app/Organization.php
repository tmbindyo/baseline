<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function contactSales()
    {
        return $this->hasManyThrough('App\Sale','App\Contact')->with('contact');
    }
    public function toDos()
    {
        return $this->hasMany('App\ToDo');
    }

    // Parents
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    public function parentPrganization()
    {
        return $this->belongsTo('App\Organization', 'id', 'parent_account_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
