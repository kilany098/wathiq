<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $guarded = ['id'];
    protected $table = 'cities';

public function zones(){
    return $this->hasMany(zone::class);
}
    
}
