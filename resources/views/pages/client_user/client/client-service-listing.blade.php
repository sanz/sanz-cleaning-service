@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Service Listing')

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="box_general padding_bottom">
	<div class="header_box">
		<a class="font-large-20 btn btn-success mr-3" href="{{route('clients.services.form',"insert")}}"><i
				class="fa fa-plus"></i></a>
		<h2 class="d-inline-block ">Service Listings</h2>
	</div>
	<div class="list_general">
		<ul>
			@if (empty($serviceList))
			<div class="box_general box padding_bottom text-center">
				<div class="row h-100">
					<div class="col-12 my-auto">
						<div class="mx-auto">
							<div class="align-middle">
								<span class="font-weight-bolder float-none text-dark font-large-30 ">You haven't add any service
									yet!!</span>
							</div>
							<div class="text-center ">
								<a href="{{route('clients.services.form','insert')}}"
									class="btn_1 mt-2 font-weight-bolder">Add New
									Service</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@else
			@foreach ($serviceList as $value)
			<li>
				<figure><img src="{{asset($value['img'])}}" alt="Service Image"></figure>
				<small>{{$value['service_cat']}}</small>
				<h4>{{$value['name']}}</h4>
				<div>{{$value['service_name']}} </div>
				<div class="my-1">Address: {{$value['address']}} </div>
				<p>
					<button type="button" class="btn_1 gray modal_btn" data-id="{{$value['main_id']}}">
						<i class="fa fa-fw fa-eye"></i> View Service
					</button>
					<a href=" {{ route('clients.services.form', $value['main_id'] ) }}" class="btn_1 gray "><i
							class="fa fa-fw fa-edit"></i> Edit</a>
				</p>
				<ul class="buttons">
					<li class="">
						@if( $value['status'] == "Active")
						<a href="#" class="btn_1 gray s_status approve" data-id="{{$value['main_id']}}"
							data-action="Active" data-status="{{$value['status_id']}}"><i
								class="fa fa-fw fa-check"></i> Active</a>
						@elseif( $value['status'] == "Inactive" )
						<a href="#" class="btn_1 gray s_status delete" data-id="{{$value['main_id']}}"
							data-action="Inactive" data-status="{{$value['status_id']}}"><i
								class="fa fa-fw fa-ban mr-1"></i> Inactive</a>
						@elseif( $value['status'] == "Pending" )
							<button class="btn_1 gray btn_status" data-action="Pending"><i class="fa fa-clock-o mr-1"></i> Pending</button>
						@elseif( $value['status'] == "Rejected" )
							<button class="btn_1 gray btn_status" data-action="Rejected"><i class="fa fa-fw fa-ban mr-1"></i>Rejected</button>
						@elseif( $value['status'] == "Blocked" )
							<button class="btn_1 gray btn_status" data-action="Blocked"><i class="fa fa-fw fa-ban mr-1"></i>Blocked</button>
						@endif
					</li>
				</ul>
			</li>
			@endforeach
			@endif
		</ul>
	</div>
</div>
<!-- /box_general-->


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
							<h2><i class="fa fa-file text-pink"></i>Service info</h2>
						</div>
						<div class="row">
							<div class="col-md-3">
								<img src="{{ asset('images/client/ser_img/1729262673-1614601090.jpg') }}"
									class="img-thumbnail service_img" alt="Cinque Terre">
							</div>
							<div class="col-md-4">
								<div class="mt-20">
									<div class="col-sm-12 small pl-0">Provider Name :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_name">
									</div>
								</div>

								<div class="mt-15">
									<div class="col-sm-12 small pl-0">Expericence :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_exp">
									</div>
								</div>

							</div>
							<div class="col-md-5">
								<div class="mt-20">
									<div class="col-sm-12 small pl-0">Service :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 service_name">
									</div>
								</div>

								<div class="mt-10">
									<div class="col-sm-12 small pl-0">Category :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 service_cate">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-5 mt-20">
								<div>
									<div class="user-info">
										<div>
											<span class="col-sm-12 small pl-0">Phone : </span>
											<span
												class="col-sm-12 font-weight-bold pl-0 ser_phone">
											</span>
										</div>
										<div>
											<span class="col-sm-12 small pl-0">E-mail : </span>
											<span class="col-sm-12 font-weight-bold pl-0"><a
													href="mailto:" class="ser_email"
													target="_blank"> </a></span>
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
										class="btn_1 gray view_doc">
										<i class="fa fa-file"></i>&nbsp;View Document
									</a>
								</span>
							</div>
							<div class="col-md-6">
								<div class="col-md-6 mt-10">
									<div class="col-sm-12 small pl-0">Aadhar No.:</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 doc_num">
									</div>
								</div>

							</div>
						</div>

						<div class="header_box version_2 mt-4">
							<h2><i class="fa fa-map-marker"></i>Location</h2>
						</div>

						<div class="row">
							<div class="col-md-6 mt-10">
								<div class="col-sm-12 small pl-0">City :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0 city">Mahesana
								</div>
							</div>
							<div class="col-md-6 mt-10">
								<div class="col-sm-12 small pl-0">State :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0 state">Gujarat
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-8">
								<div class="mt-10">
									<div class="col-sm-12 small pl-0">Address :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 address">
										20, Madhuvan
										Complex, Radhanpur Cross road, Mahesana-2</div>
								</div>
							</div>
							<div class="col-md-4 mt-10">
								<div class="col-sm-12 small pl-0">Pin Code :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0 pin_code">
									384340</div>
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

				<div class="modal-footer">
					<a class="btn btn-primary edit_btn" href="{{route('clients.services.form',"0")}}">Edit
						Service</a>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				</div>

			</div>
		</div>
	</div>
</div>
{{-- END: View Modal --}}
@endsection

@section('page-script')
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('client_user/client/js/page-scripts/client-service-listing.js')}}"></script>
@endsection