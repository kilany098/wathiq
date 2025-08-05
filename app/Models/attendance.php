<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    protected $guarded = ['id'];

    protected $table = 'attendances';

    public function Employee()
    {
        return $this->belongsTo(employee_info::class, 'employee_id');
    }
}
