<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'tanggal', 'keterangan', 'name', 'qty', 'price', 'subtotal', 'user_id'
    ];
}
