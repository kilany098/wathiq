<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account;

class AccountController extends Controller
{
   public function index()
    {
        $accounts = account::with('children')
            ->whereNull('parent_id')
            ->orderBy('code')
            ->get();
            
        return view('financial.chart', compact('accounts'));
    }


    // حفظ حساب جديد
   public function store(Request $request)
{
    $data = [
        'parent_id' => $request->input('parent_id'),
        'code' => $request->input('code'),
        'name' => $request->input('name'),
        'type' => $request->input('type')
    ];

    $validated = validator($data, [
        'parent_id' => 'nullable|exists:accounts,id',
        'code' => 'required|unique:accounts,code',
        'name' => 'required|string|max:255',
        'type' => 'required|in:asset,liability,equity,revenue,expense'
    ])->validate();
    
    account::create($validated);
    
    return redirect()->route('accounts.index')
        ->with('success', 'تم إنشاء الحساب بنجاح');
}

    // عرض نموذج تعديل حساب
    public function edit(account $account)
    {
        $parentAccounts = account::whereNull('parent_id')
            ->orderBy('code')
            ->get();
            
         return response()->json(['parentAccounts' => $parentAccounts], 201);
    }

    // تحديث حساب
    public function update(Request $request, account $account)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:accounts,id',
            'code' => 'required|unique:accounts,code,' . $account->id,
            'name' => 'required|string|max:255',
            'type' => 'required|in:asset,liability,equity,revenue,expense'
        ]);

        $account->update($validated);
        
        return redirect()->route('accounts.index')
            ->with('success', 'تم تحديث الحساب بنجاح');
    }

    // حذف حساب
    public function destroy(account $account)
    {
        // التحقق من عدم وجود معاملات مرتبطة بالحساب
        if ($account->transactionDetails()->count() > 0) {
            return redirect()->route('accounts.index')
                ->with('error', 'لا يمكن حذف الحساب لأنه مرتبط بمعاملات مالية');
        }
        
        // التحقق من عدم وجود حسابات فرعية
        if ($account->children()->count() > 0) {
            return redirect()->route('accounts.index')
                ->with('error', 'لا يمكن حذف الحساب لأنه يحتوي على حسابات فرعية');
        }
        
        $account->delete();
        
        return redirect()->route('accounts.index')
            ->with('success', 'تم حذف الحساب بنجاح');
    }
}
