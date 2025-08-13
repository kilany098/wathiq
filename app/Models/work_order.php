<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class work_order extends Model
{
    protected $guarded = ['id'];
    protected $table = 'work_orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function contract()
    {
        return $this->belongsTo(contract::class, 'contract_id');
    }
    public function transactions(){
        return $this->hasMany(transaction::class);
    }
    public function workers(){
        return $this->hasMany(worker::class);
    }
}
