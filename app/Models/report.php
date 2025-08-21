<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    protected $guarded = ['id'];
    protected $table = 'reports';

    public function used_items(){
        return $this->hasMany(used_item::class);
    }
    public function order(){
        return $this->belongsTo(work_order::class,'order_id');
    }
    
}
