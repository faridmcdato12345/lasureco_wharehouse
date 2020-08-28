<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_Received extends Model
{
    protected $guarded = [];

    public function material(){
        return $this->belongsTo(Material::class,'id');
    }
}
