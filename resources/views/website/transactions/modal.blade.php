<div class="d-inline-block">
    <div
        class="modal fade"
        id="transactionsModal"
        tabindex="-1"
        aria-labelledby="transactionsModal"
        aria-hidden="true"
        data-bs-backdrop="static"
    >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Last 5 Transactions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('website.transactions.table')
                </div>
            </div>
        </div>
    </div>
</div>
