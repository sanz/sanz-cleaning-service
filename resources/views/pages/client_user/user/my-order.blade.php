@extends('layouts.client_user.user-contentLayoutMaster')

@section('title','My Order')

@section('custom-style')
<link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="box_general padding_bottom">
	<div class="header_box">
		<h2 class="d-inline-block">My Orders</h2>
		<!-- <div class="filter">
        <select name="orderby" class="selectbox">
          <option value="Any status">Any status</option>
          <option value="Completed">Completed</option>
          <option value="Running">Running</option>
          <option value="Pending">Pending</option>
          <option value="Cancelled">Cancelled</option>
        </select>
      </div> -->
	</div>
	<div class="list_general">
		@if (!$data->first())
		<div class="box_general box text-center">
			<div class="row h-100">
				<div class="col-sm-12 my-auto">
					<div class="mx-auto">
						<div class="align-middle">
							<span class="font-weight-bolder text-dark font-large-30 ">You don't place any order
								yet!!</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		@else
		<ul class="od_div">
			@foreach ($data as $dt)
			<li>
				<figure><img src="{{asset('client_user/client/img/avatar.jpg')}}" alt=""></figure>
				<h4>{{$dt->name}} <i
						class="{{(($dt->service_status)?(($dt->service_status=='pending')?"pending":"approved"):"cancel")}} od_status">{{$dt->service_status}}</i>
				</h4>
				<ul class="booking_list">
					<li><strong>Order ID</strong> {{$dt->order_code}}</li>
					<li><strong>Booking date</strong> {{date_format(date_create($dt->booking_date),"d/m/Y")}}</li>
					<li><strong>Booking time-slot</strong> {{$dt->time_slot}}</li>
					<li><strong>Amount</strong> {{$dt->amount}} Rs</li>
					<li><strong>Address</strong> {{$dt->address}}</li>
				</ul>
				<p>
					<a href="{{ route( "customers.orders.invoice",  $dt->order_code)}}" target="_black" class="btn_1 gray">
            <i class="fa fa-fw fa-eye font-large-15 mr-1"></i>View Receipt
          </a>
					<a href="{{route('customers.reviews.show',['id'=>$dt->service_id])}}" class="btn_1 gray ml-sm-2 mt-2 mt-sm-0"><i
							class="fa fa-fw fa-stack-exchange font-large-15 mr-1"></i>
						@if ($dt->usrReview)
						Edit Your review
						@else
						Leave a review
						@endif
					</a>
				</p>
				@if($dt->service_status == 'pending')
				<ul class="buttons">
					<li><a href="#" class="od_approve btn_1 gray approve" data-id="{{$dt->order_id}}"><i
								class="fa fa-fw fa-check-square-o font-large-15 mr-1"></i>Mark as Completed</a></li>
				</ul>
				@endif
			</li>
			@endforeach
		</ul>
		@endif
	</div>
</div>
@endsection

@section('page-script')
<script src="{{asset('client_user/user/scripts/my-order.js')}}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
