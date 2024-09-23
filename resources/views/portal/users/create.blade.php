<div class="offcanvas offcanvas-end" tabindex="-1" id="create-user" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title"> Update Profile </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="create-user-form pt-0 needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label" for="username"> Username </label>
                <input type="text" name="username" class="form-control" required placeholder="John Doe" autocomplete="off">
                <div class="invalid-feedback"> Please enter your username </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="phone"> Phone </label>
                <input type="text" name="email" class="form-control" required placeholder="Enter phone number">
                <div class="invalid-feedback"> Please enter your phone number </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="email"> Email </label>
                <input type="email" name="email" class="form-control" required placeholder="Enter email address">
                <div class="invalid-feedback"> Please enter email address </div>
            </div>

            <h6 id="create-user-response" class="hidden text-center" style="font-size: 100%;"></h6>

            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"> <div class="spinner-border create-user-spinner" style="display: none;"></div> Save Changes </button>

            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas"> Cancel </button>
        </form>
    </div>
</div>