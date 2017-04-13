<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'product_id', 'name',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
