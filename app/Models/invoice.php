<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $guarded = ['id'];
    protected $table = 'invoices';

    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }
    public function contract()
    {
        return $this->belongsTo(contract::class, 'contract_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
