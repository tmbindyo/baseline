<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Parents
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categoryUser()
    {
        return $this->belongsTo('App\User', 'category_user_id', 'id');
    }


    // // Children
    // public function categoryExpenseItems()
    // {
    //     return $this->hasMany('App\CategoryExpenseItem');
    // }
}
