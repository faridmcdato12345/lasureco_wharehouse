<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Material extends Model
{
    protected $guarded = [];

    public function vouchers(){
        return $this->belongsToMany(Voucher::class)->withTimestamps()->withPivot('voucher_code','place_of_const','quantity','description_of_work','mct_number','issued_by','received_by','order_type','order_number');
    }

    public function material_received(){
        return $this->hasMany(Material_Received::class,'material_id');
    }

    public function material_released(){
        return $this->hasMany(Material_Released::class,'material_id');
    }

    public function material_credit(){
        return $this->hasMany(Material_Credit::class,'material_id');
    }
}
