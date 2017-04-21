<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    protected $table = 'product_packages';
    protected $fillable = [
        'package', 'priceHRK',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
