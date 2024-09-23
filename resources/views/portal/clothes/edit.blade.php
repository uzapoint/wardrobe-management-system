<div class="offcanvas offcanvas-end" tabindex="-1" id="edit-user-cloth" aria-labelledby="offcanvasAddUserLabel">
	<div class="offcanvas-header">
		<h5 id="offcanvasAddUserLabel" class="offcanvas-title"> Add Cloth </h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>

	<div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
		<form class="edit-user-cloth-form pt-0 needs-validation" novalidate>
			@csrf

			<div class="mb-3">
				<label class="form-label" for="cloth type"> Cloth Type </label>
				<select name="user_cloth_type_id" required class="user-cloth-type-id select2 form-select form-select-lg" data-allow-clear="true" required data-placeholder="Select cloth type">
					<option value=""> Select cloth type </option>
					@foreach($userClothTypes as $userClothType)
						<option value="{{ $userClothType->id }}"> {{ $userClothType->name }} </option>
					@endforeach
				</select>
				<div class="invalid-feedback"> Please select cloth type </div>
			</div>

			<div class="mb-3 group">
				<label class="form-label" for="color"> Color </label>
				<input type="text" name="phone" class="color form-control" required placeholder="Enter cloth color" autocomplete="off">
				<div class="invalid-feedback"> Please enter cloth color </div>
			</div>

			<div class="mb-3 individual">
				<label class="form-label" for="cloth image"> Cloth Image <strong class="text-primary">(Optional)</strong> </label>
				<input type="file" name="filename" class="form-control" autocomplete="off">
			</div>

			<h6 id="edit-user-cloth-response" class="hidden text-center" style="font-size: 100%;"></h6>

			<button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"> <div class="spinner-border edit-user-cloth-spinner" style="display: none;"></div> Submit </button>

			<button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas"> Cancel </button>
		</form>
	</div>
</div>

