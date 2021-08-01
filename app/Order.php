<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tanggal', 'keterangan', 'name', 'qty', 'price', 'subtotal', 'user_id'
    ];
}
