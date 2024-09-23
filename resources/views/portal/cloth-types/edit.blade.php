<div class="offcanvas offcanvas-end" tabindex="-1" id="edit-user-cloth-type" aria-labelledby="offcanvasAddUserLabel">
	<div class="offcanvas-header">
		<h5 id="offcanvasAddUserLabel" class="offcanvas-title"> Add Cloth </h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>

	<div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
		<form class="edit-user-cloth-type-form pt-0 needs-validation" novalidate>
			@csrf

			<div class="mb-3 group">
				<label class="form-label" for="name"> Name </label>
				<input type="text" name="name" class="name form-control" placeholder="Enter cloth type" autocomplete="off">
				<div class="invalid-feedback"> Please enter cloth type </div>
			</div>

			<h6 id="edit-user-cloth-type-response" class="hidden text-center" style="font-size: 100%;"></h6>

			<button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"> <div class="spinner-border edit-user-cloth-type-spinner" style="display: none;"></div> Submit </button>

			<button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas"> Cancel </button>
		</form>
	</div>
</div>

