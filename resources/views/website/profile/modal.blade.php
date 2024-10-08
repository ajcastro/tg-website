<div class="d-inline-block">
    <div
        class="modal fade"
        id="profileModal"
        tabindex="-1"
        aria-labelledby="profileModal"
        aria-hidden="true"
        data-bs-backdrop="static"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('website.profile.form')
                </div>
            </div>
        </div>
    </div>
</div>
