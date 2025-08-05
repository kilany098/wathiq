<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    protected $guarded = ['id'];
    protected $table = 'contracts';
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function workOrders()
    {
        return $this->hasMany(Work_Order::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
