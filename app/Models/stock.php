<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
     protected $guarded = ['id'];
    protected $table = 'stocks';

    public function item()
    {
        return $this->belongsTo(items::class, 'item_id');
    }
    public function warehouse(){
        return $this->belongsTo(warehouse::class,'warehouse_id');
    }
}
