<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable = [
        'Tanggal', 'Keterangan', 'Jenis', 'Berat', '@KG', 'Debit', 'Credit', 'Subtotal', 'user_id'
    ];

    public function users(){
        return $this->belongsTo(OrderHistory::class);
    }
}
