<div class="d-inline-block">
    <div
        class="modal fade"
        id="depositModal"
        tabindex="-1"
        aria-labelledby="depositModal"
        aria-hidden="true"
        data-bs-backdrop="static"
    >
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Deposit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('website.deposit.form')
                </div>
            </div>
        </div>
    </div>
</div>
