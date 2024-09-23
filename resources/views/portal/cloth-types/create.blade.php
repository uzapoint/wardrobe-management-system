<div class="offcanvas offcanvas-end" tabindex="-1" id="create-user-cloth-type" aria-labelledby="offcanvasAddUserLabel">
	<div class="offcanvas-header">
		<h5 id="offcanvasAddUserLabel" class="offcanvas-title"> Add Cloth Type </h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>

	<div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
		<form class="create-user-cloth-type-form pt-0 needs-validation" novalidate>
			@csrf

			<div class="mb-3 user-cloth-type">
				<label class="form-label" for="name"> Name </label>
				<input type="text" name="names[]" class="form-control" required placeholder="Enter cloth type" autocomplete="off">
				<div class="invalid-feedback"> Please enter cloth color </div>
			</div>

			<div class="col-md-12">
                <div class="form-group">
                    <div class="form-group mb-3">
                        <a id="add-user-cloth-type" class="btn btn-sm btn-outline-primary" href="javascript:void(0)"> <i class="fa fa-plus-circle"></i> More Types </a> 
                    </div>
                </div>
            </div>

			<h6 id="create-user-cloth-type-response" class="hidden text-center" style="font-size: 100%;"></h6>

			<button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"> <div class="spinner-border create-user-cloth-type-spinner" style="display: none;"></div> Submit </button>

			<button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas"> Cancel </button>
		</form>
	</div>
</div>

