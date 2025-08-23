<div class="list-group-item">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $account->code }} - {{ $account->name }}</strong>
            <span class="text-muted"> | {{ __('Balance') }}: {{ number_format($account->balance, 2) }} {{ __('SAR') }}</span>
        </div>
        <div>
            <button class="btn btn-sm btn-outline-primary me-1 edit-account-btn"
                    data-id="{{ $account->id }}"
                    data-code="{{ $account->code }}"
                    data-name="{{ $account->name }}"
                    data-type="{{ $account->type }}"
                    data-parent-id="{{ $account->parent_id }}">
                <iconify-icon icon="solar:pen-2-broken"></iconify-icon>
            </button>
            <button class="btn btn-sm btn-outline-danger delete-account-btn" data-id="{{ $account->id }}">
                <iconify-icon icon="solar:trash-bin-trash-broken"></iconify-icon>
            </button>
        </div>
    </div>
    
    @if($account->children && $account->children->count() > 0)
        <div class="ms-4 mt-2">
            <div class="list-group">
                @foreach($account->children as $childAccount)
                    @include('financial.partials.account-item', ['account' => $childAccount])
                @endforeach
            </div>
        </div>
    @endif
</div>