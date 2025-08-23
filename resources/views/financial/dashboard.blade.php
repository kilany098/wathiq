@extends('layouts.master')
@section('title',__('categories_panel'))
@section('content')
     <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <h2 class="mb-4 text-dark">{{__('Pesticide Management System Dashboard')}}</h2>
                
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm bg-gradient" style="background: rgb(100,100,100);">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{__('Accounts')}}</h5>
                                <h2>145</h2>
                                <p class="card-text">{{__('Dynamic chart of accounts')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm bg-gradient" style="background: rgb(100,100,100);">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{__('Invoices')}}</h5>
                                <h2>342</h2>
                                <p class="card-text">{{__('Invoices issued this month')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm bg-gradient" style="background: rgb(100,100,100);">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{__('Customers')}}</h5>
                                <h2>87</h2>
                                <p class="card-text">{{__('Active customer in system')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm bg-gradient" style="background: rgb(100,100,100);">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{__('Products')}}</h5>
                                <h2>54</h2>
                                <p class="card-text">{{__('Product and pesticide in stock')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">{{__('Recent Invoices')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{__('Invoice Number')}}</th>
                                                <th>{{__('Customer')}}</th>
                                                <th>{{__('Amount')}}</th>
                                                <th>{{__('Status')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>INV-2023-1056</td>
                                                <td>Palm Farm</td>
                                                <td>2,450 SAR</td>
                                                <td><span class="badge bg-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td>INV-2023-1055</td>
                                                <td>Gardens Company</td>
                                                <td>4,800 SAR</td>
                                                <td><span class="badge bg-warning text-dark">Partial</span></td>
                                            </tr>
                                            <tr>
                                                <td>INV-2023-1054</td>
                                                <td>City Municipality</td>
                                                <td>7,200 SAR</td>
                                                <td><span class="badge bg-danger">Overdue</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">{{__('Recent Transactions')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Account')}}</th>
                                                <th>{{__('Description')}}</th>
                                                <th>{{__('Amount')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>11/15/2023</td>
                                                <td>Al Ahli Bank</td>
                                                <td>Invoice collection</td>
                                                <td class="text-success">+2,450 SAR</td>
                                            </tr>
                                            <tr>
                                                <td>11/14/2023</td>
                                                <td>Suppliers</td>
                                                <td>Pesticide purchase</td>
                                                <td class="text-danger">-1,800 SAR</td>
                                            </tr>
                                            <tr>
                                                <td>11/13/2023</td>
                                                <td>Cash</td>
                                                <td>Transport expenses</td>
                                                <td class="text-danger">-350 SAR</td>
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
@endsection
