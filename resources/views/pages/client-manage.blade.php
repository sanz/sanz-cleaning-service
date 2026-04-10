@extends('layouts/contentLayoutMaster')

@section('title', 'Clients')

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
									{{-- <div class="action-btns">
                      <div class="btn-dropdown ">
                        <div class="btn-group dropdown actions-dropodown">
                          <button type="button"
                                  class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                                  data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i
                                class="feather icon-trash-2"></i> Delete</a>
                            <a class="dropdown-item" href="#"><i
                                class="feather icon-clipboard"></i> Archive</a>
                            <a class="dropdown-item" href="#"><i
                                class="feather icon-printer"></i> Print</a>
                            <a class="dropdown-item" href="#"><i
                                class="feather icon-download"></i> CSV</a>
                          </div>
                        </div>
                      </div>
                    </div> --}}
								</div>
							</div>
						</div>
					</div>

					<div id="myGrid-clientManage" class="aggrid ag-theme-material"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Ag Grid users list section end -->

</section>
<!-- users list ends -->

{{-- START: View Modal --}}
<div class="modal fade" id="viewClientModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">View Client</h4>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">×</span></button>
			</div>

			<div class="modal-body container-fluid">
				<div class="row">
					<div class="box_general m-md-4 w-100 pb-4 viewservicespan">
						<div class="header_box version_2">
							<h2><i class="fa fa-user"></i>Client Info </h2>
						</div>
						<div class="row mt-2">
							<div class="col-sm-3">
								<img class="img-thumbnail client_img">
							</div>
							<div class="col-sm-4">
								<div class="mt-2 mt-sm-0">
									<div class="col-sm-12 pl-0">ClientID :</div>
									<div class="col-sm-12 font-large-17 font-weight-bold pl-0 clientId">
									</div>
								</div>

								<div class="mt-15">
									<div class="col-sm-12 pl-0">Name :</div>
									<div class="col-sm-12 font-large-17 font-weight-bold pl-0 client_name">
									</div>
								</div>

							</div>
							<div class="col-sm-5">
								<div class="font-weight-bold pl-0">
									<span class="col-sm-12 pl-0">status :</span>
									<span class="badge badge-pill mr-1 mt-1 mt-sm-0 mb-1 client_status"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8 mt-2">
								<div>
									<div class="user-info">
										<div>
											<span class="col-sm-12 pl-0">Mobile No. : </span>
											<span class="col-sm-12 font-weight-bold pl-0 "><a href="tel:"
													class="client_moblie" target="_blank"></a></span>
										</div>
										<div>
											<span class="col-sm-12 pl-0">E-mail : </span>
											<span class="col-sm-12 font-weight-bold pl-0 "><a href="mailto:"
													class="client_email text-break" target="_blank"></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="header_box version_2 mt-4">
									<h2><i class="fa fa-file"></i>Service Info</h2>
								</div>
								<div class="table-responsive-md col-xl-10 mt-2">
									<table
										class="table table-borderless table-striped table-hover-animation service_list">
										<caption>List of Services</caption>
										<thead class="thead-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Service Provider</th>
												<th scope="col">Service</th>
												<th scope="col">Category</th>
											</tr>
										</thead>
										<tbody>
											{{-- Code Here --}}
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
<script src="{{ asset('js/scripts/ui/client-manage.js') }}"></script>
<script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection