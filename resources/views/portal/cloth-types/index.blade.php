@extends('layouts.portal.app')
	@section('content')
		<div class="content-wrapper">
		<div class="container-xxl flex-grow-1 container-p-y">
			<div class="card">
				<h4 class="breadcrumb"> 
					<span class="text-muted fw-light breadcrumb-link"> Home /</span> Customers - {{ $userClothTypes->total() }} records fetched <br>
				</h4>

				@if(Session::has('errorResponse')) 
					<h6 class="row"> 
						<div class="col-md-12 temporary-alert">
							<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-info-circle"></i> {!! Session::has('errorResponse') ? Session::get("errorResponse") : '' !!} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button> </div>
						</div>
					</h6>
				@endif

				<div class="card-header d-flex border-top rounded-0 flex-wrap py-2">
					<div class="me-5 ms-n2 pe-5">
						<div id="DataTables_Table_0_filter" class="dataTables_filter">
							<label><input type="search" class="form-control" placeholder="Search Product" aria-controls="DataTables_Table_0"></label>
						</div>
					</div>

					<div class="ms-auto d-flex justify-content-start justify-content-md-end align-items-baseline pull-right">
						<div class="dt-action-buttons d-flex flex-column align-items-start align-items-md-center justify-content-sm-center mb-3 mb-md-0 pt-0 gap-4 gap-sm-0 flex-sm-row">
							<div class="dt-buttons btn-group flex-wrap d-flex"> 

								<a href="javascript:;" class="btn btn-secondary add-new btn-primary ms-2 ms-sm-0 waves-effect waves-light create-user-cloth-type disabled-btn"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> Add Cloth Type </span></a> 
							</div>
						</div>
					</div>
				</div>

				<div class="card-datatable table-responsive">
					<table class="table">
						<thead class="border-top">
							<tr>
								<th> # </th>
								<th> Name </th>
								<th> No. Cloth </th>
								<th> Actions </th>
							</tr>
						</thead>

						<tbody>
							@foreach($userClothTypes as $userClothType)
								<tr>
									<td> {{ $userClothType->ref_no }} </td>

									<td> {{ $userClothType->name }} </td>

									<td> {{ number_format(count($userClothType->userClothes)) }} </td>

									<td> 
										<a href="{{ $userClothType->id }}" name="{{ $userClothType->name }}"  class="edit-user-cloth-type disabled-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit Cloth"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg> </a>

										<a href="{{ $userClothType->id }}" class="delete-user-cloth-type disabled-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete Cloth"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg> </a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="pr-5"> {{ $userClothTypes->render() }} </div>
				</div>
			</div>
		</div>

		@include('portal.cloth-types.create')
		<script type="text/javascript" src="{{ url('custom/cloth-types/create.js') }}"></script>

		@include('portal.cloth-types.edit')
		<script type="text/javascript" src="{{ url('custom/cloth-types/edit.js') }}"></script>

		@include('portal.cloth-types.delete')
		<script type="text/javascript" src="{{ url('custom/cloth-types/delete.js') }}"></script>
	@endsection

