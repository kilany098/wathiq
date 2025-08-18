<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قيد يومي | Journal Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .debit-col { background-color: #e8f5e9; }
        .credit-col { background-color: #ffebee; }
        .totals-row { font-weight: bold; background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-book me-2"></i> تسجيل قيد يومي | Journal Entry</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label">تاريخ القيد</label>
                            <input type="date" class="form-control" value="2023-07-15">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">رقم القيد</label>
                            <input type="text" class="form-control" value="JV-2023-0015" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف</label>
                            <input type="text" class="form-control" placeholder="وصف القيد">
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="30%">الحساب</th>
                                    <th width="30%">الوصف</th>
                                    <th width="15%" class="debit-col">مدين</th>
                                    <th width="15%" class="credit-col">دائن</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select">
                                            <option value="">اختر الحساب</option>
                                            <option value="1.1.1" selected>1.1.1 - النقدية</option>
                                            <option value="4.1">4.1 - إيرادات المبيعات</option>
                                            <option value="5.1">5.1 - مصروفات الرواتب</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" value="إيراد من عميل أحمد"></td>
                                    <td class="debit-col"><input type="number" class="form-control" value="5000.00"></td>
                                    <td class="credit-col"><input type="number" class="form-control" value="0.00"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="form-select">
                                            <option value="">اختر الحساب</option>
                                            <option value="1.1.1">1.1.1 - النقدية</option>
                                            <option value="4.1" selected>4.1 - إيرادات المبيعات</option>
                                            <option value="5.1">5.1 - مصروفات الرواتب</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" value="إيراد من عميل أحمد"></td>
                                    <td class="debit-col"><input type="number" class="form-control" value="0.00"></td>
                                    <td class="credit-col"><input type="number" class="form-control" value="5000.00"></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="totals-row">
                                    <td colspan="2" class="text-end">المجموع:</td>
                                    <td class="debit-col text-end">5,000.00</td>
                                    <td class="credit-col text-end">5,000.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus me-1"></i> إضافة بند
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            يجب أن يتساوى مجموع المدين مع الدائن قبل الحفظ
                        </div>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-save me-1"></i> حفظ القيد
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>