@extends('layouts/contentLayoutMaster')

@section('title', 'Service Prices')

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
									<button type="button" data-toggle="modal" data-target="#ServicePricesFormDiv"
										class="btn btn-icon btn-icon rounded-1 ml-0 ml-sm-1 mt-1 mt-sm-0 btn-outline-primary font-medium-1 btn-flat-primary waves-effect waves-light ">
										<i class="feather icon-percent"></i>Default Rules
									</button>
								</div>
								<div class="ag-btns d-flex flex-wrap">
									<input type="text" class="ag-grid-filter form-control mr-1 mb-1 mb-sm-0"
										id="filter-text-box" placeholder="Search...." />
								</div>
							</div>
						</div>
					</div>

					<div id="myGrid-servicePrices" class="aggrid ag-theme-material"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Ag Grid users list section end -->

	{{-- START: Model --}}
	<div class="modal fade text-left" id="ServicePricesFormDiv" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="ServicePricesFormModel">Update Service Price</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="javaScript:void(0)" id="ServicePricesForm" method="post" novalidate>
					<div class="modal-body">
						<div id="hidemodel" class="form-group">
							<div class="controls">
								<label for="ServicePrices-service_name">Service Name: </label>
								<input type="text" name="npr_sername" id="sp_sername" placeholder="Service Name"
									class="form-control" data-validation-required-message="This field is required"
									aria-invalid="false" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<div class="controls">
										<label for="ServicePrices-visitBrokrage">Visit Charge
											Brokrage(%): </label>
										<input type="text" name="npr_visitbrokrage" id="sp_visitbrokrage"
											placeholder="Visit Charge Brokrage (%)" class="form-control"
											data-validation-required-message="This field is required"
											data-validation-containsnumber-regex="^[0-9]+(\.[0-9]{1,2})?$"
											data-validation-containsnumber-message="The numeric field may only contain numeric characters."
											aria-invalid="false">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<div class="controls">
										<label for="ServicePrices-serviceBrokrage">Service Charge
											Brokrage(%): </label>
										<input type="text" name="npr_servicebrokrage" id="sp_servicebrokrage"
											placeholder="Service Charge Brokrage (%)" class="form-control"
											data-validation-required-message="This field is required"
											data-validation-containsnumber-regex="^[0-9]+(\.[0-9]{1,2})?$"
											data-validation-containsnumber-message="The numeric field may only contain numeric characters."
											aria-invalid="false">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="sbt_btn" class="btn btn-outline-success waves-effect waves-light"
							autofocus data-action="insert">Update Service Price
						</button>
						<button type="button" id="ServicePrices-dismiss"
							class="btn btn-outline-danger waves-effect waves-light" data-dismiss="modal">Cancel
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{-- END: Model --}}
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
<script src="{{ asset('js/scripts/ui/service-prices.js') }}"></script>
<script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
