<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'Tanggal', 'Keterangan', 'Jenis', 'Berat', '@KG', 'Debit', 'Subtotal', 'user_id'
    ];
}
