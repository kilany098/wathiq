@extends('layouts.master')
@section('title','contracts_panel')
@section('content')


<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Order Header -->
                <div class="order-header text-center mb-4">
                    <h1 class="display-5 fw-bold mb-3">Work Order Details</h1>
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <span class="badge bg-light text-dark fs-6">{{$order->order_number}}</span>
                        <span class="badge bg-success status-badge">{{$order->status}}</span>
                        <span class="badge bg-warning text-dark status-badge">Priority: {{$order->priority}}</span>
                    </div>
                </div>

                <!-- Order Information Card -->
                <div class="card order-card">
                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h3 class="section-title">Order Information</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Order Number:</div>
                                    <div class="col-8 info-value">{{$order->order_number}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Title:</div>
                                    <div class="col-8 info-value">{{$order->title}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Priority:</div>
                                    <div class="col-8">
                                        @if($order->priority == 'medium')
                                        <span class="badge bg-success">{{$order->priority}}</span>
                                        @else
                                        <span class="badge bg-danger">{{$order->priority}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Status:</div>
                                    <div class="col-8">
                                        <span class="badge bg-success">{{$order->status}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="section-title">Timeline</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Start Time:</div>
                                    <div class="col-8 info-value">{{$order->start_date}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">End Time:</div>
                                    <div class="col-8 info-value">{{$order->end_date}}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h3 class="section-title">Description</h3>
                                <p class="lead">{{$order->description}}.</p>
                            </div>
                        </div>

                        <!-- Financial & Contract Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h3 class="section-title">Financial Details</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Visit Price:</div>
                                    <div class="col-8 info-value">${{$order->schedule->visit_price}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Contract Number:</div>
                                    <div class="col-8 info-value">{{$order->schedule->contract->contract_number}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Contract Type:</div>
                                    <div class="col-8 info-value">{{$order->schedule->contract->type}}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="section-title">Client Information</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Client Name:</div>
                                    <div class="col-8 info-value">{{$order->schedule->contract->client->name}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Branch Name:</div>
                                    <div class="col-8 info-value">{{$order->schedule->branch->name}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Assigned To:</div>
                                    <div class="col-8 info-value">{{$order->assigned->full_name}}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Location & Management -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h3 class="section-title">Location Details</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">City:</div>
                                    <div class="col-8 info-value">{{$order->schedule->branch->city->name}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Zone:</div>
                                    <div class="col-8 info-value">{{$order->schedule->branch->zone->name}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Map Location:</div>
                                    <div class="col-8">
                                        <a href="{{$order->schedule->branch->map_link}}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-geo-alt"></i> View on Google Maps
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="section-title">Management Contact</h3>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Manager Name:</div>
                                    <div class="col-8 info-value">{{$order->schedule->branch->manager_name}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 info-label">Manager Phone:</div>
                                    <div class="col-8 info-value">
                                        <a href="tel:+15551234567" class="text-decoration-none">
                                            <i class="bi bi-telephone"></i>{{$order->schedule->branch->manager_phone}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Preview -->
                        <div class="row">
                            <div class="col-12">
                                <h3 class="section-title">Location Map</h3>
                                <div class="map-container bg-light d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <i class="bi bi-map display-1 text-muted"></i>
                                        <p class="mt-3">Map preview would be displayed here</p>
                                        <a href="{{$order->schedule->branch->map_link}}" target="_blank" class="btn btn-primary">
                                            <i class="bi bi-geo-alt"></i> Open in Google Maps
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@if (strtotime($order->start_date) < time())
                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Finish the Order
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script src="{{ asset('asset/admin/js/operation/contract.js') }}"></script>
@endpush