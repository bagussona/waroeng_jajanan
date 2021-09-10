<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpbCart extends Model
{
    protected $fillable = [
        'name', 'slug', 'keterangan', 'category', 'description', 'image', 'price', 'stock', 'supplier', 'author'
    ];
}
