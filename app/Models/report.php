<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
     protected $guarded = ['id'];
     protected $table = 'reports';


public function images(){
    return $this->morphMany(image::class,'imageable');
}
}
