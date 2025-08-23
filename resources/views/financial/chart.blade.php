@extends('layouts.master')
@section('title', __('Accounts Panel'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark">{{ __('Chart of Accounts') }}</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <iconify-icon icon="solar:pen-2-broken" class="me-2"></iconify-icon>{{ __('Add New Account') }}
                    </button>
                </div>

                <!-- Display Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">{{ __('Account Structure') }}</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($accounts) && $accounts->count() > 0)
                            <div class="list-group">
                                @foreach($accounts as $account)
                                    @include('financial.partials.account-item', ['account' => $account])
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <iconify-icon icon="solar:pie-chart-broken" width="48" height="48" class="text-muted"></iconify-icon>
                                <p class="mt-3 text-muted">{{ __('No accounts found. Create your first account to get started.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding New Account -->
    <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountModalLabel">{{ __('Add New Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAccountForm" action="{{ route('accounts.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="parentAccount" class="form-label">{{ __('Parent Account') }}</label>
                            <select class="form-select" id="parentAccount" name="parent_id">
                                <option value="">{{ __('None (Main Account)') }}</option>
                                @if(isset($accounts) && $accounts->count() > 0)
                                    @foreach($accounts as $parentAccount)
                                        <option value="{{ $parentAccount->id }}">{{ $parentAccount->code }} - {{ $parentAccount->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="accountCode" class="form-label">{{ __('Account Code') }}</label>
                            <input type="text" class="form-control" id="accountCode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="accountName" class="form-label">{{ __('Account Name') }}</label>
                            <input type="text" class="form-control" id="accountName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="accountType" class="form-label">{{ __('Account Type') }}</label>
                            <select class="form-select" id="accountType" name="type" required>
                                <option value="asset">{{ __('Assets') }}</option>
                                <option value="liability">{{ __('Liabilities') }}</option>
                                <option value="equity">{{ __('Equity') }}</option>
                                <option value="revenue">{{ __('Revenues') }}</option>
                                <option value="expense">{{ __('Expenses') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Account -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">{{ __('Edit Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAccountForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editParentAccount" class="form-label">{{ __('Parent Account') }}</label>
                            <select class="form-select" id="editParentAccount" name="parent_id">
                                <option value="">{{ __('None (Main Account)') }}</option>
                                @if(isset($accounts) && $accounts->count() > 0)
                                    @foreach($accounts as $parentAccount)
                                        <option value="{{ $parentAccount->id }}">{{ $parentAccount->code }} - {{ $parentAccount->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountCode" class="form-label">{{ __('Account Code') }}</label>
                            <input type="text" class="form-control" id="editAccountCode" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountName" class="form-label">{{ __('Account Name') }}</label>
                            <input type="text" class="form-control" id="editAccountName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAccountType" class="form-label">{{ __('Account Type') }}</label>
                            <select class="form-select" id="editAccountType" name="type" required>
                                <option value="asset">{{ __('Assets') }}</option>
                                <option value="liability">{{ __('Liabilities') }}</option>
                                <option value="equity">{{ __('Equity') }}</option>
                                <option value="revenue">{{ __('Revenues') }}</option>
                                <option value="expense">{{ __('Expenses') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">{{ __('Confirm Delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to delete this account? This action cannot be undone.') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <form id="deleteAccountForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button clicks
        const editButtons = document.querySelectorAll('.edit-account-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const accountId = this.getAttribute('data-id');
                const accountCode = this.getAttribute('data-code');
                const accountName = this.getAttribute('data-name');
                const accountType = this.getAttribute('data-type');
                const parentId = this.getAttribute('data-parent-id');
                
                // Set form action
                document.getElementById('editAccountForm').action = `/accounts/${accountId}`;
                
                // Populate form fields
                document.getElementById('editAccountCode').value = accountCode;
                document.getElementById('editAccountName').value = accountName;
                document.getElementById('editAccountType').value = accountType;
                document.getElementById('editParentAccount').value = parentId || '';
                
                // Show modal
                new bootstrap.Modal(document.getElementById('editAccountModal')).show();
            });
        });
        
        // Handle delete button clicks
        const deleteButtons = document.querySelectorAll('.delete-account-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const accountId = this.getAttribute('data-id');
                
                // Set form action
                document.getElementById('deleteAccountForm').action = `/accounts/${accountId}`;
                
                // Show modal
                new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
            });
        });
    });
</script>
@endpush