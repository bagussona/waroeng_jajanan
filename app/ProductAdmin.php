<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAdmin extends Model
{
    protected $fillable = [
        'name', 'category_id', 'description', 'image', 'price', 'stock', 'price_supplier', 'supplier'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
