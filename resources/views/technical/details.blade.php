@extends('layouts.master')
@section('title','contracts_panel')
@section('content')


<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                 @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Please check the form below for errors
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
    @if ( $order->status == 'assigned')
                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReportModal">
                        <i class="bi bi-pencil"></i> Finish the Order
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>


<div class="modal fade" id="createReportModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBranchModalLabel">Submit Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <form id="createReportForm" action="{{ route('report.submit')}}"  method="POST">
                    @csrf
                    @method('POST')
                              <input type="hidden" name="order_id" value="{{$order->id}}">
                              <input type="hidden" name="name" value="{{$order->schedule->branch->manager_name}}">
                              <input type="hidden" name="address" value="{{$order->schedule->branch->city->name.' '.$order->schedule->branch->zone->name}}">
                            <!-- Service Details -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3 class="border-bottom pb-2 mb-4 text-primary">
                                        <i class="bi bi-calendar-event me-2"></i>Service Details
                                    </h3>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="date" class="form-label">Service Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                </div>
                            </div>
                            
                            <!-- Infestation Details -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3 class="border-bottom pb-2 mb-4 text-primary">
                                        <i class="bi bi-bug me-2"></i>Infestation Details
                                    </h3>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="infestation" class="form-label">Type of Infestation <span class="text-danger">*</span></label>
                                    <select class="form-select" id="infestation" name="infestation" required>
                                        <option value="">Select infestation type</option>
                                        <option value="Cockroaches">Cockroaches</option>
                                        <option value="Ants">Ants</option>
                                        <option value="Rodents">Rodents</option>
                                        <option value="Termites">Termites</option>
                                        <option value="Mosquitoes">Mosquitoes</option>
                                        <option value="Flies">Flies</option>
                                        <option value="Bed Bugs">Bed Bugs</option>
                                        <option value="Spiders">Spiders</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intensity" class="form-label">Infestation Intensity <span class="text-danger">*</span></label>
                                    <select class="form-select" id="intensity" name="intensity" required>
                                        <option value="">Select intensity</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="sprayed_places" class="form-label">Treated Areas <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="sprayed_places" name="sprayed_places" required rows="2" placeholder="List all areas that were treated (e.g., Kitchen, Bathroom, Living Room)"></textarea>
                                </div>
                            </div>
                            
                            <!-- Treatment Details -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3 class="border-bottom pb-2 mb-4 text-primary">
                                        <i class="bi bi-droplet-fill me-2"></i>Treatment Details
                                    </h3>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="item_id" class="form-label">Product Used <span class="text-danger">*</span></label>
                                    <select class="form-select" id="item_id" name="item_id" required>
                                        <option value="">Select product</option>
                                        @foreach ($items as $item)
                                        <option value="{{$item->item->id}}">{{$item->item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="dilution" class="form-label">Dilution Ratio <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="dilution" name="dilution" step="0.01" min="0" placeholder="0.00" required>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="item_id_2" class="form-label">Product Used <span class="text-danger">*</span></label>
                                    <select class="form-select" id="item_id_2" name="item_id_2" >
                                        <option value="">Select product</option>
                                        @foreach ($items as $item)
                                        <option value="{{$item->item->id}}">{{$item->item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="dilution_2" class="form-label">Dilution Ratio <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="dilution_2" name="dilution_2" step="0.01" min="0" placeholder="0.00" >
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="item_id_3" class="form-label">Product Used <span class="text-danger">*</span></label>
                                    <select class="form-select" id="item_id_3" name="item_id_3" >
                                        <option value="">Select product</option>
                                        @foreach ($items as $item)
                                        <option value="{{$item->item->id}}">{{$item->item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="dilution_3" class="form-label">Dilution Ratio <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="dilution_3" name="dilution_3" step="0.01" min="0" placeholder="0.00" >
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Evaluation -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3 class="border-bottom pb-2 mb-4 text-primary">
                                        <i class="bi bi-clipboard-check me-2"></i>Evaluation
                                    </h3>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="evaluation" class="form-label">Service Evaluation <span class="text-danger">*</span></label>
                                    <select class="form-select" id="evaluation" name="evaluation" required>
                                        <option value="">Select evaluation</option>
                                        <option value="Weak">Weak</option>
                                        <option value="Good">Good</option>
                                        <option value="Excellent">Excellent</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Additional notes or observations"></textarea>
                                </div>
                            </div>
                            
                            <!-- Signature -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h3 class="border-bottom pb-2 mb-4 text-primary">
                                        <i class="bi bi-pen-fill me-2"></i>Client Signature
                                    </h3>
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>Please draw your signature in the box below using your mouse or touchscreen.
                                    </div>
                                    
                                    <div class="border rounded p-3 mb-3">
                                        <canvas id="signaturePad" class="w-100" height="200" style="touch-action: none; cursor: crosshair;"></canvas>
                                    </div>
                                     <input type="hidden" id="signature" name="signature" required>
                                    <div class="d-flex gap-2 mb-3">
                                        <button type="button" id="clearBtn" class="btn btn-danger">
                                            <i class="bi bi-eraser me-2"></i>Clear Signature
                                        </button>
                                        <button type="button" id="saveBtn" class="btn btn-success">
                                            <i class="bi bi-check-circle me-2"></i>Save Signature
                                        </button>
                                    </div>
                                    
                                    <div class="alert alert-secondary mt-3 d-none" id="signaturePreview">
                                        <p class="mb-2">Signature preview:</p>
                                        <img id="signatureImage" src="" alt="Client signature" class="img-fluid border rounded p-2">
                                    </div>
                                </div>
                            </div>
                            
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createReportForm" class="btn btn-primary">Submit Report</button>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set today's date as default
            document.getElementById('date').valueAsDate = new Date();
            
            // Set default times
            document.getElementById('start_time').value = '09:00';
            document.getElementById('end_time').value = '10:00';
            
            // Initialize signature pad
            const canvas = document.getElementById('signaturePad');
            const ctx = canvas.getContext('2d');
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;
            let signatureData = '';
            
            // Set up canvas context
            ctx.lineWidth = 2;
            ctx.lineJoin = 'round';
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#3498db';
            
            // Function to handle drawing
            function draw(e) {
                if (!isDrawing) return;
                
                // Handle both mouse and touch events
                let clientX, clientY;
                if (e.type.includes('touch')) {
                    clientX = e.touches[0].clientX;
                    clientY = e.touches[0].clientY;
                } else {
                    clientX = e.clientX;
                    clientY = e.clientY;
                }
                
                const rect = canvas.getBoundingClientRect();
                const x = clientX - rect.left;
                const y = clientY - rect.top;
                
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(x, y);
                ctx.stroke();
                
                [lastX, lastY] = [x, y];
            }
            
            // Mouse events
            canvas.addEventListener('mousedown', (e) => {
                isDrawing = true;
                const rect = canvas.getBoundingClientRect();
                [lastX, lastY] = [e.clientX - rect.left, e.clientY - rect.top];
            });
            
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', () => isDrawing = false);
            canvas.addEventListener('mouseout', () => isDrawing = false);
            
            // Touch events for mobile devices
            canvas.addEventListener('touchstart', (e) => {
                e.preventDefault();
                isDrawing = true;
                const rect = canvas.getBoundingClientRect();
                [lastX, lastY] = [e.touches[0].clientX - rect.left, e.touches[0].clientY - rect.top];
            });
            
            canvas.addEventListener('touchmove', (e) => {
                e.preventDefault();
                draw(e);
            });
            
            canvas.addEventListener('touchend', () => isDrawing = false);
            
            // Clear signature
            document.getElementById('clearBtn').addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                signatureData = '';
                document.getElementById('signaturePreview').classList.add('d-none');
            });
            
            // Save signature as data URL
            document.getElementById('saveBtn').addEventListener('click', function() {
                if (ctx.getImageData(0, 0, canvas.width, canvas.height).data.some(channel => channel !== 0)) {
                    signatureData = canvas.toDataURL();
                    document.getElementById('signature').value = signatureData;
                    document.getElementById('signatureImage').src = signatureData;
                    document.getElementById('signaturePreview').classList.remove('d-none');
                } else {
                    alert('Please provide a signature before saving.');
                }
            });
            
            // Form submission
            document.getElementById('serviceForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!signatureData) {
                    alert('Please provide your signature before submitting the form.');
                    return;
                }
                
                // Validate end time is after start time
                const startTime = document.getElementById('start_time').value;
                const endTime = document.getElementById('end_time').value;
                
                if (startTime >= endTime) {
                    alert('End time must be after start time.');
                    return;
                }
                
                // In a real application, you would send the form data and signature to the server
                // For this example, we'll just show a success message
                alert('Service report submitted successfully!');
                
                // Here you would typically send the data to your server
                // const formData = new FormData(this);
                // formData.append('signature', signatureData);
                // fetch('/submit-service-report', { method: 'POST', body: formData });
                
                // Reset form
                this.reset();
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                document.getElementById('signaturePreview').classList.add('d-none');
                document.getElementById('date').valueAsDate = new Date();
                document.getElementById('start_time').value = '09:00';
                document.getElementById('end_time').value = '10:00';
            });
        });
    </script>
<script src="{{ asset('asset/admin/js/operation/contract.js') }}"></script>
@endpush