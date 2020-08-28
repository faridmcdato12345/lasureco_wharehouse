<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_Released extends Model
{
    protected $guarded = [];

    public function material(){
        return $this->belongsTo(Material::class,'id');
    }
}
