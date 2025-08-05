<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded = ['id'];
    protected $table = 'categories';

    public function items()
    {
        return $this->hasMany(items::class);
    }
}
