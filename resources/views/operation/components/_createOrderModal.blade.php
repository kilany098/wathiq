<div class="modal fade" id="createOrderModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createContractModalLabel">Create Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createOrderForm">
                    @csrf

                    <!-- Order Number -->
                    <div class="mb-3 col-md-6">
                        <label for="order_number" class="form-label">Order Number *</label>
                        <input type="text" class="form-control" id="order_number" name="order_number" required>
                    </div>

                    <!-- Contract ID -->
                    <div class="mb-3 col-md-6">
                        <label for="contract_id" class="form-label">Contract *</label>
                        <select class="form-control" id="contract_id" name="contract_id" required>
                            <option value="">Select Contract</option>
                            @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}">{{ $contract->contract_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="mb-3 col-md-12">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <!-- Priority -->
                    <div class="mb-3 col-md-6">
                        <label for="priority" class="form-label">Priority *</label>
                        <select class="form-control" id="priority" name="priority" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-3 col-md-6">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date">
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createOrderForm" class="btn btn-primary" id="createContractButton">Create Work Order</button>
            </div>
        </div>
    </div>
</div>