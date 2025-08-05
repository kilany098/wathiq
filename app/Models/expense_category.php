<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expense_category extends Model
{
    protected $guarded = ['id'];
    protected $table = 'expense_categories';

    public function expenses()
    {
        return $this->hasMany(expense::class);
    }
}
