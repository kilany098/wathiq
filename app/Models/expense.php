<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    protected $guarded = ['id'];
    protected $table = 'expenses';

    public function category()
    {
        return $this->belongsTo(expense_category::class, 'category_id');
    }
    public function contract()
    {
        return $this->hasOne(contract::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
