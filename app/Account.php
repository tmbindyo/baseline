<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
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
    public function account_type()
    {
        return $this->belongsTo('App\AccountType');
    }
    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    // Children
    public function composite_product_selling_accounts()
    {
        return $this->hasMany('App\CompositeProduct','id','selling_account_id');
    }
    public function composite_product_purchase_accounts()
    {
        return $this->hasMany('App\CompositeProduct','id','purchase_account_id');
    }
    public function composite_product_inventory_accounts()
    {
        return $this->hasMany('App\CompositeProduct','id','inventory_account_id');
    }
    public function expense_accounts()
    {
        return $this->hasMany('App\Expense','id','expense_account_id');
    }
    public function inventory_adjustments()
    {
        return $this->hasMany('App\InventoryAdjustment');
    }
    public function manual_journal_accounts()
    {
        return $this->hasMany('App\ManualJournalAccount');
    }
    public function product_selling_accounts()
    {
        return $this->hasMany('App\Product','id','selling_account_id');
    }
    public function product_purchase_accounts()
    {
        return $this->hasMany('App\Product','id','purchase_account_id');
    }
    public function product_inventory_accounts()
    {
        return $this->hasMany('App\Product','id','inventory_account_id');
    }
    public function source_accounts()
    {
        return $this->hasMany('App\Transaction','id','source_account_id');
    }
    public function destination_accounts()
    {
        return $this->hasMany('App\Transaction','id','destination_account_id');
    }
}
