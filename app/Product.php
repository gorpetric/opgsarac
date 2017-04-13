<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }

    public function mainImage()
    {
        return $this->images()->first();
    }

    public function otherImages()
    {
        return $this->images()->where('id', '<>', $this->mainImage()->id)->get();
    }
}
