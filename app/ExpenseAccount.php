<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseAccount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

    // Children
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    // Parents
    public function accountType()
    {
        return $this->belongsTo('App\AccountType');
    }
    public function budget()
    {
        return $this->hasOne('App\Budget');
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
