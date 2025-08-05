<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $guarded = ['id'];
    protected $table = 'transactions';

    public function warehouse()
    {
        return $this->belongsTo(warehouse::class, 'warehouse_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function item()
    {
        return $this->belongsTo(items::class, 'item_id');
    }
}
