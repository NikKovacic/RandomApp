<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="deleteModalText"></div>
                <div class="result-alert mt-4"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="deleteModalSubmit" data-model="" data-action="" data-id="" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="module" src="{{asset('modules/module-delete-modal.js')}}" defer></script>
@endpush
