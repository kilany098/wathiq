<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tech_item extends Model
{
    protected $guarded = ['id'];
    protected $table = 'tech_items';

    public function item()
    {
        return $this->belongsTo(items::class, 'item_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
