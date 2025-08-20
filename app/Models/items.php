<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    protected $guarded = ['id'];
    protected $table = 'items';

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    public function transactions()
    {
        return $this->hasMany(transaction::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(warehouse::class, 'warehouse_id');
    }
    public function stocks()
    {
        return $this->hasMany(stock::class);
    }
    public function tech_item()
    {
        return $this->hasOne(tech_item::class);
    }
}
