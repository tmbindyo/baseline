<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryExpense extends Model implements Auditable
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
    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    // Children
    public function categoryExpenseItems()
    {
        return $this->hasMany('App\CategoryExpenseItem');
    }
}
