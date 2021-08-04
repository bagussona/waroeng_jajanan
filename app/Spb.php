<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    protected $fillable = [
        'name', 'slug', 'keterangan', 'category', 'description', 'image', 'price', 'stock', 'supplier', 'author'
    ];

}
