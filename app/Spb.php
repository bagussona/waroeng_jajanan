<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    protected $fillable = [
        'name', 'category', 'description', 'image', 'price', 'stock', 'supplier', 'author'
    ];

}
