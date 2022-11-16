<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, UuidTrait;
    public $incrementing = false;

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

    // children
    public function subCategories()
    {
        return $this->hasMany('App\SubCategory');
    }
    public function categoryExpenses()
    {
        return $this->hasMany('App\CategoryExpense');
    }
    public function categoryUsers()
    {
        return $this->hasMany('App\CategoryUser');
    }







    public function categoryTotalSubTotal()
    {
        // return $this->categoryExpenses();
        return $this->categoryExpenses()
        ->selectRaw('category_id,SUM(sub_total) as sub_total')
        ->groupBy('category_id');
    }
    public function categoryTotalAdjustment()
    {
        // return $this->categoryExpenses();
        return $this->categoryExpenses()
        ->selectRaw('category_id,SUM(adjustment) as adjustments')
        ->groupBy('category_id');
    }
    public function categoryTotalTotal()
    {
        // return $this->categoryExpenses();
        return $this->categoryExpenses()
        ->selectRaw('category_id,SUM(total) as totals')
        ->groupBy('category_id');
    }
    public function categoryTotalPaid()
    {
        // return $this->categoryExpenses();
        return $this->categoryExpenses()
        ->selectRaw('category_id,SUM(paid) as paid')
        ->groupBy('category_id');
    }
    public function categoryTotalBalance()
    {
        // return $this->categoryExpenses();
        return $this->categoryExpenses()
        ->selectRaw('category_id,SUM(balance) as balance')
        ->groupBy('category_id');
    }


    // public function groupTry()
    // {
    //     return $this->hasMany('App\SubscriptionModule')
    //     ->selectRaw('module_id,SUM(amount)')
    //     ->groupBy('module_id');
    // }
}
