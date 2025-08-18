<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقارير المالية | Financial Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .summary-card { transition: transform 0.3s; }
        .summary-card:hover { transform: translateY(-5px); }
        .balance-sheet-header { background-color: #e9ecef; }
        .balance-sheet-total { background-color: #f8f9fa; font-weight: bold; }
        .chart-container { position: relative; height: 300px; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-chart-line me-2"></i> التقارير المالية | Financial Reports</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card summary-card text-white bg-success h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-money-bill-wave me-2"></i> إجمالي الإيرادات
                                </h5>
                                <p class="card-text display-4">250,000 <small>ر.س</small></p>
                                <p class="mb-0"><small>زيادة 15% عن الشهر الماضي</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card summary-card text-white bg-info h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-wallet me-2"></i> إجمالي الأرباح
                                </h5>
                                <p class="card-text display-4">75,000 <small>ر.س</small></p>
                                <p class="mb-0"><small>هامش ربح 30%</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card summary-card text-white bg-warning h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-receipt me-2"></i> إجمالي المصروفات
                                </h5>
                                <p class="card-text display-4">175,000 <small>ر.س</small></p>
                                <p class="mb-0"><small>زيادة 10% عن الشهر الماضي</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-pie me-2"></i> تقرير الأرباح والخسائر
                                </h5>
                            </div>
                            <div class="card-body">
                                <form class="row g-3 mb-4">
                                    <div class="col-md-5">
                                        <label class="form-label">من تاريخ</label>
                                        <input type="date" class="form-control" value="2023-01-01">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">إلى تاريخ</label>
                                        <input type="date" class="form-control" value="2023-07-31">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary w-100">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </form>
                                
                                <div class="chart-container">
                                    <canvas id="profitLossChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-balance-scale me-2"></i> الميزانية العمومية
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr class="balance-sheet-header">
                                                <th colspan="2">الأصول</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>النقدية وما في حكمها</td>
                                                <td class="text-end">50,000 ر.س</td>
                                            </tr>
                                            <tr>
                                                <td>الذمم المدينة</td>
                                                <td class="text-end">30,000 ر.س</td>
                                            </tr>
                                            <tr>
                                                <td>المخزون</td>
                                                <td class="text-end">70,000 ر.س</td>
                                            </tr>
                                            <tr class="balance-sheet-total">
                                                <td><strong>إجمالي الأصول</strong></td>
                                                <td class="text-end"><strong>150,000 ر.س</strong></td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr class="balance-sheet-header">
                                                <th colspan="2">الخصوم وحقوق الملكية</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>الذمم الدائنة</td>
                                                <td class="text-end">40,000 ر.س</td>
                                            </tr>
                                            <tr>
                                                <td>القروض</td>
                                                <td class="text-end">60,000 ر.س</td>
                                            </tr>
                                            <tr>
                                                <td>رأس المال</td>
                                                <td class="text-end">100,000 ر.س</td>
                                            </tr>
                                            <tr>
                                                <td>الأرباح المحتجزة</td>
                                                <td class="text-end">-50,000 ر.س</td>
                                            </tr>
                                            <tr class="balance-sheet-total">
                                                <td><strong>إجمالي الخصوم وحقوق الملكية</strong></td>
                                                <td class="text-end"><strong>150,000 ر.س</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Profit & Loss Chart
        const ctx = document.getElementById('profitLossChart').getContext('2d');
        const profitLossChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو'],
                datasets: [
                    {
                        label: 'الإيرادات',
                        data: [30000, 35000, 40000, 45000, 50000, 55000, 60000],
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'المصروفات',
                        data: [20000, 22000, 25000, 30000, 32000, 35000, 38000],
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        rtl: true
                    },
                    tooltip: {
                        rtl: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw.toLocaleString() + ' ر.س';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' ر.س';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>