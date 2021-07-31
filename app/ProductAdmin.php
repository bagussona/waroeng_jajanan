<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAdmin extends Model
{
    protected $fillable = [
        'name', 'category_id', 'description', 'image', 'price_supplier', 'stock', 'price', 'supplier_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
