@extends('layouts/contentLayoutMaster')

@section('title', 'Services')

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
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
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
									<button
										class="btn btn-white filter-btn dropdown-toggle border text-dark"
										type="button" id="dropdownMenuButton6"
										data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										1 - 20 of 50
									</button>
									<div class="dropdown-menu dropdown-menu-right"
										aria-labelledby="dropdownMenuButton6">
										<a class="dropdown-item" href="#">20</a>
										<a class="dropdown-item" href="#">50</a>
									</div>
								</div>
								<div class="ag-btns d-flex flex-wrap">
									<input type="text"
										class="ag-grid-filter form-control mr-1 mb-1 mb-sm-0"
										id="filter-text-box" placeholder="Search...." />
								</div>
							</div>
						</div>
					</div>

					<div id="myGrid-serviceManage" class="aggrid ag-theme-material"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Ag Grid users list section end -->
</section>
<!-- users list ends -->

{{-- START: View Modal --}}
<div class="modal fade" id="viewServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">View Service</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body container-fluid">
				<div class="row">
					<div class="box_general m-sm-4 w-100 pb-4 viewservicespan">
						<div class="header_box version_2">
							<h2><i class="fa fa-file"></i>Service info</h2>
						</div>
						<div class="row">
							<div class="col-md-3">
								<img src="" class="img-thumbnail service_img" alt="Cinque Terre">
							</div>
							<div class="col-md-4">
								<div class="mt-20">
									<div class="col-sm-12 pl-0">Provider Name :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_name">
									</div>
								</div>

								<div class="mt-15">
									<div class="col-sm-12 pl-0">Expericence :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_exp">
									</div>
								</div>

							</div>
							<div class="col-md-5">
								<div class="mt-20">
									<div class="col-sm-12 pl-0">Service :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 service_name">
									</div>
								</div>

								<div class="mt-10">
									<div class="col-sm-12 pl-0">Category :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 service_cate">
										Cleaning </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 mt-20">
								<div>
									<div class="user-info">
										<div>
											<span class="col-sm-12 pl-0">Phone : </span>
											<span
												class="col-sm-12 font-weight-bold pl-0 ser_phone"></span>
										</div>
										<div>
											<span class="col-sm-12 pl-0">E-mail : </span>
											<span class="col-sm-12 font-weight-bold pl-0 "><a
													href="mailto:" class="ser_email"
													target="_blank"></a></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="mt-20">
									<div class="col-sm-12 small pl-0">Social Media :</div>
									<div class="social mt-15"></div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="mt-20">
									<div class="col-sm-12 small pl-0">Description :</div>
									<div class="col-sm-12 pl-0 ser_des"> </div>
								</div>
							</div>
						</div>

						<div class="header_box version_2 mt-4">
							<h2><i class="fa fa-paperclip"></i>Document</h2>
						</div>

						<div class="row">
							<div class="col-md-6">
								<span class="mb-10">
									<a href="#" type="button" target="_blank"
										class="btn btn-flat-dark mr-1 mb-1 waves-effect waves-light .round view_doc">
										<i class="fa fa-file"></i>&nbsp;View Document
									</a>
								</span>
							</div>
							<div class="col-md-6">
								<span>Aadhar No.: </span>
								<span class="doc_num"></span>
							</div>
						</div>

						<div class="header_box version_2 mt-4">
							<h2><i class="fa fa-map-marker"></i>Location</h2>
						</div>

						<div class="row">
							<div class="col-md-6">
								<span>
									<label>City: </label>
									<label class="city"></label>
								</span>
							</div>
							<div class="col-md-6">
								<span>
									<label>State: </label>
									<label class="state"></label>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<span>
									<label>Address: </label>
									<label class="address"></label>
								</span>
							</div>
							<div class="col-md-6">
								<span>
									<label>Pincode: </label>
									<label class="pin_code"></label>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 col-lg-4 col-sm-12">
								<div class="header_box version_2 mt-4">
									<h2><i class="fa fa-clock-o"></i>Availability</h2>
								</div>

								<div class="table-responsive-sm ">
									<table class="table table-borderless day_time">
										<caption>List of Working Days in Week</caption>
										<thead>
											<tr>
												<th scope="col">Days</th>
												<th scope="col">Time</th>
											</tr>
										</thead>
										<tbody>
											{{-- Code Here --}}
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-7 col-lg-7 col-sm-12">
								<div class="header_box version_2 mt-4">
									<h2><i class="fa fa-dollar"></i>Pricing</h2>
								</div>

								<div class="table-responsive-sm ">
									<table class="table table-borderless list_item">
										<caption>List of Item</caption>
										<thead>
											<tr class="d-flex">
												<th class="col-md-3">Item</th>
												<th class="col-md-2">Price</th>
												<th class="col-md-7">Description</th>
											</tr>
										</thead>
										<tbody>
											{{-- Code Here  --}}
										</tbody>
									</table>
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
<script src="{{ asset('js/scripts/ui/service-manage.js') }}"></script>
<script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection