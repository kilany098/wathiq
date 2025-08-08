<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    protected $guarded = ['id'];
    protected $table = 'warehouses';

    public function user()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function transactions()
    {
        return $this->hasMany(transaction::class);
    }
    public function items(){
        return $this->hasMany(items::class);
    }
     public function stocks()
    {
        return $this->hasMany(stock::class);
    }
}
