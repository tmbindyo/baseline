<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseItem extends Model
{
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
    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    // Children
    public function restock()
    {
        return $this->hasOne('App\Restock');
    }
}
