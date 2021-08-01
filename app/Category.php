<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    //MUTATOR
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

    //ACCESSOR
    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function products(){
        return $this->hasMany(Category::class);
    }

    public function productAdmins(){
        return $this->hasMany(Category::class);
    }
}
