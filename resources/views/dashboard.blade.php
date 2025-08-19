@extends('layouts.master')
@section('title','Dashboard')
@section('content')
 <div class="container-fluid mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Employee Performance Dashboard</h2>
            <button class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Export PDF
            </button>
            <button class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Export EXCEL
            </button>
        </div>

        

        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card kpi-card border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Completed Jobs</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">142</div>
                                <div class="mt-2 text-success small">
                                    <i class="bi bi-arrow-up me-1"></i>12% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle-fill text-success fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card kpi-card border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Customer Rating</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">4.8/5</div>
                                <div class="mt-2 text-primary small">
                                    <i class="bi bi-star-fill me-1"></i>98% satisfaction
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-star-fill text-primary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card kpi-card border-0 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Revenue Generated</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">$12,840</div>
                                <div class="mt-2 text-success small">
                                    <i class="bi bi-arrow-up me-1"></i>8% from last month
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar text-info fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                        <h6 class="m-0 fw-bold">Jobs Completed by Type</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">Last Month</a></li>
                                <li><a class="dropdown-item" href="#">This Quarter</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="jobTypeChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                        <h6 class="m-0 fw-bold">Monthly Performance Trend</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-calendar me-1"></i>Date Range
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
                                <li><a class="dropdown-item" href="#">Last 6 Months</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="performanceChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee List -->
        <div class="card border-0 shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold">Top Performers</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="employeeTable">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Jobs Completed</th>
                                <th>Rating</th>
                                <th>Revenue</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">  
                                        <div>
                                            <div class="fw-bold">Michael Chen</div>
                                            <div class="text-muted">Technician</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold">156</td>
                                <td class="fw-bold text-warning">4.9/5</td>
                                <td class="fw-bold">$14,200</td>
                                <td><span class="badge bg-success performance-badge">Top Performer</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold">Sarah Johnson</div>
                                            <div class="text-muted">Technician</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold">142</td>
                                <td class="fw-bold text-warning">4.8/5</td>
                                <td class="fw-bold">$12,840</td>
                                <td><span class="badge bg-primary performance-badge">Excellent</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="fw-bold">David Wilson</div>
                                            <div class="text-muted">Technician</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold">118</td>
                                <td class="fw-bold text-warning">4.6/5</td>
                                <td class="fw-bold">$9,850</td>
                                <td><span class="badge bg-warning performance-badge">Good</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Job Type Chart
            const jobTypeCtx = document.getElementById('jobTypeChart').getContext('2d');
            const jobTypeChart = new Chart(jobTypeCtx, {
                type: 'doughnut',
                data: {
                    labels: ['General Pest', 'Termite', 'Rodent', 'Mosquito', 'Bed Bug'],
                    datasets: [{
                        data: [45, 25, 15, 10, 5],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(153, 102, 255, 0.8)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });

            // Performance Trend Chart
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            const performanceChart = new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    datasets: [{
                        label: 'Jobs Completed',
                        data: [120, 125, 130, 128, 135, 142, 138, 142],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Customer Rating',
                        data: [4.6, 4.7, 4.7, 4.8, 4.8, 4.8, 4.7, 4.8],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        fill: true,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Jobs Completed'
                            }
                        },
                        y1: {
                            position: 'right',
                            min: 4.5,
                            max: 5.0,
                            title: {
                                display: true,
                                text: 'Customer Rating'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection