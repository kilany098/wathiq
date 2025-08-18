<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شجرة الحسابات | Chart of Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .account-type-asset { background-color: #e3f2fd; }
        .account-type-liability { background-color: #fff8e1; }
        .account-type-equity { background-color: #e8f5e9; }
        .account-type-income { background-color: #f3e5f5; }
        .account-type-expense { background-color: #ffebee; }
        .tree-indent { padding-left: 20px; }
        .account-code { font-family: monospace; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4><i class="fas fa-sitemap me-2"></i> شجرة الحسابات | Chart of Accounts</h4>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                    <i class="fas fa-plus me-1"></i> إضافة حساب
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="15%">كود الحساب</th>
                                <th>اسم الحساب</th>
                                <th width="15%">نوع الحساب</th>
                                <th width="15%">الرصيد</th>
                                <th width="10%">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Assets -->
                            <tr class="account-type-asset fw-bold">
                                <td>1</td>
                                <td>الأصول | Assets</td>
                                <td>أصول</td>
                                <td class="text-end">250,000.00</td>
                                <td></td>
                            </tr>
                            
                            <!-- Current Assets (Child of Assets) -->
                            <tr class="account-type-asset tree-indent">
                                <td>1.1</td>
                                <td>الأصول المتداولة | Current Assets</td>
                                <td>أصول</td>
                                <td class="text-end">150,000.00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            
                            <!-- Cash Account (Child of Current Assets) -->
                            <tr class="account-type-asset tree-indent" style="padding-left: 40px;">
                                <td>1.1.1</td>
                                <td>النقدية | Cash</td>
                                <td>أصول</td>
                                <td class="text-end">50,000.00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            
                            <!-- Liabilities -->
                            <tr class="account-type-liability fw-bold">
                                <td>2</td>
                                <td>الخصوم | Liabilities</td>
                                <td>خصوم</td>
                                <td class="text-end">100,000.00</td>
                                <td></td>
                            </tr>
                            
                            <!-- Equity -->
                            <tr class="account-type-equity fw-bold">
                                <td>3</td>
                                <td>حقوق الملكية | Equity</td>
                                <td>ملكية</td>
                                <td class="text-end">150,000.00</td>
                                <td></td>
                            </tr>
                            
                            <!-- Income -->
                            <tr class="account-type-income fw-bold">
                                <td>4</td>
                                <td>الإيرادات | Income</td>
                                <td>إيرادات</td>
                                <td class="text-end">300,000.00</td>
                                <td></td>
                            </tr>
                            
                            <!-- Expenses -->
                            <tr class="account-type-expense fw-bold">
                                <td>5</td>
                                <td>المصروفات | Expenses</td>
                                <td>مصروفات</td>
                                <td class="text-end">200,000.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Account Modal -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">إضافة حساب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">اسم الحساب (عربي)</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Name (English)</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كود الحساب</label>
                            <input type="text" class="form-control" placeholder="1.1.2">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الحساب الرئيسي</label>
                            <select class="form-select">
                                <option value="">لا يوجد (حساب رئيسي)</option>
                                <option value="1">1 - الأصول</option>
                                <option value="1.1">1.1 - الأصول المتداولة</option>
                                <option value="2">2 - الخصوم</option>
                                <option value="3">3 - حقوق الملكية</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">نوع الحساب</label>
                            <select class="form-select">
                                <option value="asset">أصول</option>
                                <option value="liability">خصوم</option>
                                <option value="equity">حقوق ملكية</option>
                                <option value="income">إيرادات</option>
                                <option value="expense">مصروفات</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>