@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Manage Orders')

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="box_general padding_bottom">
	<div class="header_box">
		<h2 class="d-inline-block">Orders List</h2>
		{{-- <div class="filter">
				<select name="orderby" class="selectbox">
					<option value="Any status">Any status</option>
					<option value="Completed">Completed</option>
					<option value="Pending">Pending</option>
					<option value="Cancelled">Cancelled</option>
				</select>
			</div> --}}
	</div>

	<div class="list_general">
		@if (empty($orderList))
		<div class="box_general box padding_bottom text-center">
			<div class="row h-100">
				<div class="col-sm-12 my-auto">
					<div class="mx-auto">
						<div class="align-middle">
							<span class="font-weight-bolder text-dark font-large-30 ">You haven't get any
								order yet!!</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		@else
		<ul>
			@foreach ($orderList as $value)
			<li>
				<figure><img src="{{$value['service_img']}}" alt="Service Img"></figure>
				<h4>{{$value['service_name']}}
					@if ($value['service_status'] == "pending")
					<i class="pending">Pending</i>
					@elseif($value['service_status'] == "approved")
					<i class="approved">Completed</i>
					@elseif($value['service_status'] == "cancel")
					<i class="cancel">Cancelled</i>
					@endif
				</h4>
				<ul class="booking_list">
					<li><strong>Order ID</strong>{{$value['order_id']}}</li>
					<li><strong>Booking Date</strong>{{$value['booking_date']}}</li>
					<li><strong>Booking Time</strong>{{$value['booking_time']}}</li>
					<li><strong>City</strong>{{$value['city']}}</li>
					<li><strong>Address</strong>{{$value['address']}}</li>
				</ul>
				<ul class="buttons">
					<li><button class="btn_1 gray btnViewModal" data-id="{{$value['main_id']}}"><i
								class="fa fa-fw fa-eye"></i> View More</button></li>
				</ul>
			</li>
			@endforeach
		</ul>
		@endif
	</div>
</div>
<!-- /box_general-->

{{-- START: Modal --}}
<div class="modal fade custom-modal" id="viewOrderModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Order Details</h4>
				<button class="close " type="button" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true" class="font-large-20"><i
							class="fa fa-fw fa-close"></i></span></button>
			</div>
			<div class="modal-body container-fluid">
				<div class="row">
					<div class="box_general m-4 w-100 pb-4 viewservicespan">
						<div class="header_box version_2">
							<h2><i class="fa fa-file text-pink"></i>Order Info</h2>
						</div>
						<div class="mt-5">
							<div class="col-sm-12 small pl-0 mb-5">Provider Name :</div>
							<div class="col-sm-12 font-large-17 font-weight-bold pl-0 provider_name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6  mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Order ID :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0 order_id">
								</div>
							</div>
							<div class="col-md-6 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Status :</div>
								<div class="service_status"><i
										class="font-size-small approved">Completed</i></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Service :</div>
								<div
									class="col-sm-12 font-large-17 font-weight-bold pl-0  service_name">
								</div>
							</div>
							<div class="col-md-6 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Category :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0  service_cat">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Booking Date :</div>
								<div
									class="col-sm-12 font-large-17 font-weight-bold pl-0  booking_date">
								</div>
							</div>
							<div class="col-md-6 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Time :</div>
								<div
									class="col-sm-12 font-large-17 font-weight-bold pl-0  booking_time">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">City :</div>
								<div class="col-sm-12 font-large-17 font-weight-bold pl-0  city"></div>
							</div>
							<div class="col-md-7 mt-5">
								<div class="col-sm-12 small pl-0 mb-5">Address :</div>
								<div class="col-sm-12 pl-0  font-weight-bold address"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="header_box version_2 mt-4">
									<h2><i class="fa fa-user text-pink"></i>User Info</h2>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">User ID :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 user_id">
									</div>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">Name :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 user_name">
									</div>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">E-mail :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 user_email">
										<a href="mailto:"></a></div>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">Contact :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 user_phone">
										<a href="tel:"></a></div>
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-5">
								<div class="header_box version_2 mt-4">
									<h2><i class="fa fa-file text-pink"></i>Client Info</h2>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">User ID :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 client_id">
									</div>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">Name :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 client_name">
									</div>
								</div>
								<div class="mt-5">
									<div class="col-sm-12 small pl-0 mb-5">E-mail :</div>
									<div
										class="col-sm-12 font-large-17 font-weight-bold pl-0 client_email">
										<a href="mailto:parth@gmail.com"></a></div>
								</div>
							</div>
						</div>
						<div class="header_box version_2 mt-4">
							<h2><i class="fa fa-dollar text-pink"></i>Pricing</h2>
						</div>
						<div class="row">
							<div class="col">
								<span>
									<label>Payment : </label>
									<label class="payment_status"><i
											class="pending">Pending</i></label>
								</span>
							</div>
						</div>
						<div class="item_list">
						</div>
						<div class="row">
							<div class="col text-right border-top">
								<span>
									<label class="font-weight-bold">Grand Total: </label>
									<label class="font-weight-bold font-large-17 grand_total"></label>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer float-right">
				<button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
{{-- END: Modal --}}
@endsection

@section('page-script')
<script src="{{asset('client_user/client/js/page-scripts/client-order-manage.js')}}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
