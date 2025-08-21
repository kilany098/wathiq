<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class used_item extends Model
{
    protected $guarded = ['id'];
    protected $table = 'used_items';

    public function item(){
    return $this->belongsTo(items::class,'item_id');
    }
    public function report(){
    return $this->belongsTo(report::class,'report_id');
    }
}
