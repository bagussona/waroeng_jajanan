<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name'
    ];

    public function productAdmins(){
        return $this->hasMany(Category::class);
    }
    
}
