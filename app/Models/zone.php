<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zone extends Model
{
    protected $guarded = ['id'];
    protected $table = 'zones';

public function city(){
    return $this->belongsTo(city::class,'city_id');
}


    
}
