<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $guarded = ['id'];
    protected $table = 'branches';

public function client(){
    return $this->belongsTo(client::class,'client_id');
}
public function zone(){
    return $this->belongsTo(zone::class,'zone_id');
}

public function city(){
    return $this->belongsTo(city::class,'city_id');
}
public function visit_schedules(){
    return $this->hasMany(visit_schedule::class);
}
}
