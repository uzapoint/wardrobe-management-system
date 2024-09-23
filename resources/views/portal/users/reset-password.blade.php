<div class="offcanvas offcanvas-end" tabindex="-1" id="reset-password" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title"> Reset Password </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="reset-password-form pt-0 needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label" for="current-password"> Current Password </label>
                <input type="password" name="current_password" class="form-control" required placeholder="xxxxxxxxxx">
                <div class="invalid-feedback"> Please enter current password </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="new-password"> New Password </label>
                <input type="password" name="new_password" class="form-control" required placeholder="xxxxxxxxxx">
                <div class="invalid-feedback"> Please enter new password </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="confirm-password"> Re-enter New Password </label>
                <input type="password" name="confirm_password" class="form-control" required placeholder="xxxxxxxxxx">
                <div class="invalid-feedback"> Please re-enter new password </div>
            </div>

            <h6 id="reset-password-response" class="hidden text-center" style="font-size: 100%;"></h6>

            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"> <div class="spinner-border reset-password-spinner" style="display: none;"></div> Change Password </button>

            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas"> Cancel </button>
        </form>
    </div>
</div>