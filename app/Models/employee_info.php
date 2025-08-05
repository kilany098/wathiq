<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee_info extends Model
{
    protected $guarded = ['id'];
    protected $table = 'employee_infos';

    public function attendance()
    {
        return $this->hasOne(attendance::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
