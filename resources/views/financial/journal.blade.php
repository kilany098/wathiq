<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الفواتير | Invoices Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .badge-draft { background-color: #6c757d; }
        .badge-sent { background-color: #0dcaf0; }
        .badge-paid { background-color: #198754; }
        .badge-overdue { background-color: #dc3545; }
        .invoice-table th { white-space: nowrap; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4><i class="fas fa-file-invoice me-2"></i> إدارة الفواتير | Invoices Management</h4>
                <div>
                    <button class="btn btn-light me-2">
                        <i class="fas fa-plus me-1"></i> فاتورة جديدة
                    </button>
                    <button class="btn btn-light">
                        <i class="fas fa-download me-1"></i> تصدير
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="draft">مسودة</option>
                            <option value="sent">مرسلة</option>
                            <option value="paid">مدفوعة</option>
                            <option value="overdue">متأخرة</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="من تاريخ">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="إلى تاريخ">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> تطبيق الفلتر
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover invoice-table">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">رقم الفاتورة</th>
                                <th>العميل</th>
                                <th width="10%">التاريخ</th>
                                <th width="10%">الاستحقاق</th>
                                <th width="12%">المبلغ</th>
                                <th width="12%">المدفوع</th>
                                <th width="10%">المتبقي</th>
                                <th width="10%">الحالة</th>
                                <th width="10%">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-2023-105</td>
                                <td>شركة التقنية المتطورة</td>
                                <td>15/07/2023</td>
                                <td class="text-danger">30/07/2023</td>
                                <td class="text-end">15,000.00</td>
                                <td class="text-end">0.00</td>
                                <td class="text-end">15,000.00</td>
                                <td><span class="badge badge-sent">مرسلة</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>INV-2023-104</td>
                                <td>شركة النظم الذكية</td>
                                <td>10/07/2023</td>
                                <td class="text-danger">25/07/2023</td>
                                <td class="text-end">8,500.00</td>
                                <td class="text-end">8,500.00</td>
                                <td class="text-end">0.00</td>
                                <td><span class="badge badge-paid">مدفوعة</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>INV-2023-103</td>
                                <td>شركة الحلول المتكاملة</td>
                                <td>01/07/2023</td>
                                <td class="text-danger">15/07/2023</td>
                                <td class="text-end">12,000.00</td>
                                <td class="text-end">0.00</td>
                                <td class="text-end">12,000.00</td>
                                <td><span class="badge badge-overdue">متأخرة</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">السابق</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">التالي</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>