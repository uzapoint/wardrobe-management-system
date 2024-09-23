@extends('layouts.portal.app')
@section('content')

<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="card">
			<h4 class="breadcrumb"> <span class="text-muted fw-light breadcrumb-link"> Home /</span> Users </h4>

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
							<!-- <div class="btn-group">
								<button class="btn btn-secondary buttons-collection btn-label-secondary me-3 waves-effect waves-light"><span><i class="ti ti-download me-1 ti-xs"></i> Export </span></button>
							</div>  -->

							@if(Auth::user()->hasRole('Super Administrator') || Auth::user()->hasRole('Administrator'))
								<a href="javascript:;" class="btn btn-secondary add-new btn-primary ms-2 ms-sm-0 waves-effect waves-light create-user disabled-btn"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> Add User </span></a> 
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="card-datatable table-responsive">
				<table class="table">
					<thead class="border-top">
						<tr>
							<th> # </th>
							<th> Names </th>
							<th> Phone </th>
							<th> Email </th>
							<th> Status </th>
							@if(Auth::user()->hasRole('Super Administrator') || Auth::user()->hasRole('Administrator'))
								<th> Actions </th>
							@endif
						</tr>
					</thead>

					<tbody>
						@foreach($users as $user)
							<tr>
								<td> {{ $user->ref_no }} </td>

								<td> {{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }} </td>

								<td> {{ $user->phone }} </td>

								<td> {{ $user->email }} </td>

								<td> @if($user->status == 1) <span class="text-success"> <svg  xmlns="http://www.w3.org/2000/svg" width="17"  height="17" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg> active </span> @else <span class="text-warning"> <svg  xmlns="http://www.w3.org/2000/svg" width="17"  height="17" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M10 10l4 4m0 -4l-4 4" /></svg> inactive </span> @endif </td>

								@if(Auth::user()->hasRole('Super Administrator') || Auth::user()->hasRole('Administrator'))
									<td> 
										<a href="{{ $user->id }}" firstName="{{ $user->first_name }}" middleName="{{ $user->middle_name }}" lastName="{{ $user->last_name }}" phone="{{ $user->phone }}" email="{{ $user->email }}" branchId="{{ $user->companyUser($user)? $user->companyUser($user)->branch_id: '' }}" class="edit-user disabled-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit User"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg> </a>

										@if($user->status == 0)
											<a href="{{ $user->id }}" class="activate-user disabled-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Activate User"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checkbox"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg> </a>
										@else
											<a href="{{ $user->id }}" class="deactivate-user disabled-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Deactivate User"> <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cancel"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M18.364 5.636l-12.728 12.728" /></svg> </a>
										@endif
									</td>
								@endif
							</tr>
						@endforeach

						{{ $users->render() }}
					</tbody>
				</table>
			</div>
		</div>
	</div>

	@include('portal.users.create')
	<script type="text/javascript" src="{{ url('custom/users/create.js') }}"></script>

	@include('portal.users.activate')
	<script type="text/javascript" src="{{ url('custom/users/activate.js') }}"></script>

	@include('portal.users.deactivate')
	<script type="text/javascript" src="{{ url('custom/users/deactivate.js') }}"></script>
@endsection

