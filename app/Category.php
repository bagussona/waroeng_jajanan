<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function Products(){
        return $this->hasMany(Category::class);
    }

    public function ProductAdmins(){
        return $this->hasMany(Category::class);
    }
}
