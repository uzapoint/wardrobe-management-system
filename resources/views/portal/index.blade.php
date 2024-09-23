@extends('layouts.portal.app')
	@section('content') 
		<div class="content-wrapper">        
			<div class="container-xxl flex-grow-1 container-p-y">
				<div class="row g-6">
					@if(Session::has('errorResponse')) 
						<h6 class="row"> 
							<div class="col-md-12 temporary-alert">
								<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-info-circle"></i> {!! Session::has('errorResponse') ? Session::get("errorResponse") : '' !!} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button> </div>
							</div>
						</h6>
					@endif

					<div class="col-xxl-6 col-md-6 col-lg-6 pt-4">
						<div class="card h-100">
							<div class="card-header d-flex justify-content-between">
								<div class="card-title mb-0">
									<h5 class="mb-1"> Clothes Types </h5>
									<p class="card-subtitle"> {{ number_format(count($userClothTypes)) }} records fetched </p>
								</div>
							</div>

							<div class="card-body">
								<ul class="p-0 m-0">
									@foreach($userClothTypes as $userClothType)
										<li class="mb-3 d-flex justify-content-between align-items-center">
											<div class="badge bg-label-success rounded p-1_5"><i class="ti ti-components ti-md"></i></div>
											<div class="d-flex justify-content-between w-100 flex-wrap">
												<h6 class="mb-0 ms-4"> {{ $userClothType->name }} </h6>
												<div class="d-flex">
													<p class="mb-0"> {{ number_format(count($userClothType->userClothes)) }} </p>
													<p class="ms-4 text-success mb-0">0.3%</p>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>

					<div class="col-xxl-6 col-xl-6 col-lg-6 pt-4">
						<div class="card h-100">
							<div class="card-header d-flex justify-content-between">
								<div class="card-title mb-0">
									<h5 class="mb-1"> Latest Clothes </h5>
									<p class="card-subtitle"> {{ number_format($userClothes->take(10)->count()) }} records fetched </p>
								</div>
							</div>

							<div class="card-body">
								<ul class="list-unstyled mb-0">
									@foreach($userClothes as $userCloth)
										<li class="mb-3">
											<div class="d-flex align-items-center">
												<div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i class="ti ti-shadow ti-md"></i></div>
												<div class="d-flex justify-content-between w-100 flex-wrap gap-2">
													<div class="me-2">
														<h6 class="mb-0"> {{ $userCloth->ref_no }} </h6>
														<small class="text-body"> {{ $userCloth->color }} </small>
													</div>
													
													<div class="d-flex align-items-center">
														<div class="ms-4 badge bg-label-success"> {{ $userCloth->userClothType? $userCloth->userClothType->name: '' }} </div>
													</div>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
	@endsection

