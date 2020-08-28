<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = [];

    public function materials(){
        return $this->belongsToMany(Material::class)->withTimestamps()->withPivot('voucher_code','place_of_const','quantity','description_of_work','mct_number','issued_by','received_by','order_type','order_number');
    }
}
