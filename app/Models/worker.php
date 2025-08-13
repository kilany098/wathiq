<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class worker extends Model
{

    protected $guarded = ['id'];
    protected $table = 'workers';
    // public function user(){
    //     return $this->belongsTo(User::class,'assigned_id');
    // }

    public function user() {
    return $this->belongsTo(User::class, 'assigned_id'); // Explicitly set the FK
}
    public function order(){
        return $this->belongsTo(work_order::class,'order_id');
    }
    public function reports(){
    return $this->hasMany(report::class);
    }
}
