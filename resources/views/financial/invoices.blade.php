@extends('layouts.master')
@section('title',__('categories_panel'))
@section('content')
   <div class="container-fluid">
        <div class="row">
          
                <!-- محتوى الصفحة -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-dark">إدارة الفواتير</h2>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>فاتورة جديدة
                        </button>
                    </div>

                    <!-- فلترة الفواتير -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">حالة الفاتورة</label>
                                    <select class="form-select">
                                        <option value="">جميع الحالات</option>
                                        <option value="draft">مسودة</option>
                                        <option value="sent">مرسلة</option>
                                        <option value="partial">مدفوعة جزئياً</option>
                                        <option value="paid">مدفوعة</option>
                                        <option value="overdue">متأخرة</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">من تاريخ</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">إلى تاريخ</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100">بحث</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- جدول الفواتير -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">قائمة الفواتير</h5>
                            <div>
                                <button class="btn btn-sm btn-light me-2">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input class="form-check-input" type="checkbox">
                                            </th>
                                            <th>رقم الفاتورة</th>
                                            <th>التاريخ</th>
                                            <th>العميل</th>
                                            <th>المبلغ</th>
                                            <th>المدفوع</th>
                                            <th>المتبقي</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>INV-2023-1056</td>
                                            <td>15/11/2023</td>
                                            <td>مزرعة النخيل</td>
                                            <td>2,450 ر.س</td>
                                            <td>2,450 ر.س</td>
                                            <td>0 ر.س</td>
                                            <td><span class="badge bg-success">مدفوعة</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning me-1">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>INV-2023-1055</td>
                                            <td>14/11/2023</td>
                                            <td>شركة الحدائق</td>
                                            <td>4,800 ر.س</td>
                                            <td>2,400 ر.س</td>
                                            <td>2,400 ر.س</td>
                                            <td><span class="badge bg-warning text-dark">جزئي</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning me-1">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>INV-2023-1054</td>
                                            <td>10/11/2023</td>
                                            <td>بلدية المدينة</td>
                                            <td>7,200 ر.س</td>
                                            <td>0 ر.س</td>
                                            <td>7,200 ر.س</td>
                                            <td><span class="badge bg-danger">متأخرة</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning me-1">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- الترقيم -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mt-4">
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
            </div>
        </div>
    </div>
 @endsection
@push('scripts')
<script src="{{ asset('asset/admin/js/inventory/category.js') }}"></script>
@endpush