<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tanggal', 'image', 'name', 'qty', 'price', 'subtotal', 'user_id'
    ];
}
