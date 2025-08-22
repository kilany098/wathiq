<div class="modal fade" id="createTransactionModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create transaction')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="createTransactionForm" >
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="item_id">{{__('Item')}}</label>
                        <select class="form-control" id="item_id" name="item_id" required>
                        <option value="">{{__('Select Item')}}</option>
                         @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                         @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="transaction_type">{{__('Transaction Type')}}</label>
                        <select class="form-control" id="transaction_type" name="transaction_type" required>
                        <option value="">{{__('Select Type')}}</option>
                        <option value="in">{{__('In (Add Stock)')}}</option>
                        <option value="out">{{__('Out (Remove Stock)')}}</option>
                        <option value="transfer">{{__('Transfer')}}</option>
                        <option value="adjustment">{{__('Adjustment')}}</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="warehouse_id">{{__('Source Warehouse')}}</label>
                        <select class="form-control" id="warehouse_id" name="warehouse_id" required>
                        <option value="">{{__('Select Warehouse')}}</option>
                        @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    
                   <div class="form-group" id="warehouse-to-group" style="display:none;">
                       <label for="warehouse_to">{{__('Destination Warehouse')}}</label>
                       <select class="form-control" id="warehouse_to" name="warehouse_to">
                       <option value="">{{__('Select Warehouse')}}</option>
                       @foreach($warehouses as $warehouse)
                       <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                       @endforeach
                       </select>
                    </div>

                    <div class="mb-3 col-md-12">
                      <label for="quantity">{{__('Quantity')}}</label>
                      <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>

                    <div class="mb-3 col-md-12">
                      <label for="related_order_id">{{__('Related Order ID (Optional)')}}</label>
                      <input type="text" class="form-control" id="related_order_id" name="related_order_id">
                    </div>
        
                    <div class="mb-3 col-md-12">
                      <label for="notes">{{__('Notes')}}</label>
                      <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createTransactionForm" class="btn btn-primary" id="createUserButton">{{__('Create item')}}</button>
            </div>
        </div>
    </div>
</div>
