<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class work_order extends Model
{
    protected $guarded = ['id'];
    protected $table = 'work_orders';

public function schedule(){
    return $this->belongsTo(visit_schedule::class,'schedule_id');
}

public function assigned(){
    return $this->belongsTo(user::class,'assigned_id');
}

public function requests()
    {
        return $this->hasMany(request::class);
    }
    public function report(){
        return $this->hasOne(report::class);
    }

}
