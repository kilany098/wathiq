<div class="modal fade" id="createCategoryModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create Category')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" action="{{ route('category.create') }}" class="row" method="POST" >
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createCategoryForm" class="btn btn-primary" id="createUserButton">{{__('Create Category')}}</button>
            </div>
        </div>
    </div>
</div>