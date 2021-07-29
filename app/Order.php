<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tanggal', 'keterangan', 'name', 'qty', 'pcs', 'subtotal', 'user_id'
    ];
}
