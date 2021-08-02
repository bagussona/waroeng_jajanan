<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->belongsTo(OrderHistory::class);
    }
}
