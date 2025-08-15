<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visit_schedule extends Model
{

    protected $guarded = ['id'];
    protected $table = 'visit_schedules';
     public function branch(){
        return $this->belongsTo(branch::class,'branch_id');
     }
     public function contract(){
        return $this->belongsTo(contract::class,'contract_id');
     }
}
