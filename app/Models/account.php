<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'type',
        'balance',
        'is_active'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // العلاقة مع الحساب الأب
    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    // العلاقة مع الحسابات الفرعية
    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    // العلاقة مع تفاصيل المعاملات
    /*public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
*/
    // طريقة لحساب الرصيد
    public function updateBalance()
    {
        $debit = $this->transactionDetails()->sum('debit');
        $credit = $this->transactionDetails()->sum('credit');
        
        if ($this->type === 'asset' || $this->type === 'expense') {
            $this->balance = $debit - $credit;
        } else {
            $this->balance = $credit - $debit;
        }
        
        $this->save();
        
        // تحديث الرصيد في الحساب الأب إذا كان له حساب أب
        if ($this->parent) {
            $this->parent->updateBalance();
        }
    }
        
}
