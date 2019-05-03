<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionType extends Model
{
    //
    use SoftDeletes;

    public function institutions()
    {
        return $this->hasMany('App\Institution');
    }
}