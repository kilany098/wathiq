<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $guarded = ['id'];
    protected $table = 'clients';

    public function invoices()
    {
        return $this->hasMany(invoice::class);
    }
    public function contracts()
    {
        return $this->hasMany(contract::class);
    }
    public function branches(){
        return $this->hasMany(branch::class);
    }
}
