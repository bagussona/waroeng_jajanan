<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ProductAdmin extends Model
{
    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'image', 'price_supplier', 'stock', 'price', 'supplier_id',
    ];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
