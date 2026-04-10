@extends('layouts/contentLayoutMaster')

@section('title', 'Customers')

@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset('css/custom/custom.css') }}">
@endsection

@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
	<!-- Ag Grid users list section start -->
	<div id="basic-examples">
		<div class="card">
			<div class="card-content">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
								<div class="dropdown sort-dropdown mb-1 mb-sm-0">
									<button class="btn btn-white filter-btn dropdown-toggle border text-dark"
										type="button" id="dropdownMenuButton6" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false">
										1 - 20 of 50
									</button>
									<div class="dropdown-menu dropdown-menu-right"
										aria-labelledby="dropdownMenuButton6">
										<a class="dropdown-item" href="#">20</a>
										<a class="dropdown-item" href="#">50</a>
									</div>
								</div>
								<div class="ag-btns d-flex flex-wrap">
									<input type="text" class="ag-grid-filter form-control mr-1 mb-1 mb-sm-0"
										id="filter-text-box" placeholder="Search...." />
								</div>
							</div>
						</div>
					</div>

					<div id="myGrid-userManage" class="aggrid ag-theme-material"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Ag Grid users list section end -->
</section>
<!-- users list ends -->

{{-- START: View Modal --}}
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">View User</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">×</span></button>
			</div>

			<div class="modal-body container-fluid">
				<div class="row">
					<div class="box_general m-sm-2 w-100 pb-4 viewservicespan">
						<div class="header_box version_2">
							<h2><i class="fa fa-user"></i>User Info</h2>
						</div>
						<div class="row mt-2">
							<div class="col-md-6">
									<span class="pl-0">UserID :</span>
									<span class="font-large-17 font-weight-bold pl-0 ml-1 userId"></span>
							</div>
							<div class="col-md-6">
								<div class="mt-1 mt-md-0">
									<span class=pl-0">status :</span>
									<span class="font-large-17 font-weight-bold pl-0">
										<label class="badge badge-pill mr-1 mb-1 ml-1 user_status"></label>
									</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div>
									<div class="mt-1">
										<span class="pl-0">Name :</span>
										<span class="font-large-17 font-weight-bold ml-1 pl-0 user_name"></span>
									</div>
									<div class="mt-1">
										<span class="pl-0">Gender : </span>
										<span class="font-weight-bold pl-0 ml-1 user_gender"></span>
									</div>
									<div class="mt-1">
										<span class="pl-0">E-mail : </span>
										<span class="font-weight-bold pl-0 ml-1 "><a href="mailto:"
												class="user_email text-break" target="_blank"></a></span>
									</div>
									<div class="mt-1">
										<span class="pl-0">Mobile No. : </span>
										<span class="font-weight-bold pl-0 ml-1 "><a href="tel:"
												class="user_moblie" target="_blank"></a></span>
									</div>
									<div class="mt-1">
										<span class="pl-0">Address : </span>
										<span class="font-weight-bold pl-0 ml-1 user_address"></span>
									</div>
									<div class="mt-1">
										<span class="pl-0">Pincode : </span>
										<span class="font-weight-bold pl-0 ml-1 user_pincode"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- END: View Modal --}}

@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
<script src="{{ asset('js/scripts/ui/user-manage.js') }}"></script>
<script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection