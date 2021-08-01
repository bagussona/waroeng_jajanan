<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable = [
        'tanggal', 'keterangan', 'name', 'qty', 'price', 'subtotal', 'user_id'
    ];

    public function users(){
        return $this->belongsTo(OrderHistory::class);
    }
}
