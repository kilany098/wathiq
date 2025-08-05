<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $guarded = ['id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
