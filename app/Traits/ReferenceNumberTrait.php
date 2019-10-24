<?php
/**
 * Created by PhpStorm.
 * User: amutis
 * Date: 2019-06-01
 * Time: 11:15
 */

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait ReferenceNumberTrait
{
    // todo generate random string to work as reference numbers
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
