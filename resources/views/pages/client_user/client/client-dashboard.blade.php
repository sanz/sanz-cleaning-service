@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Dashboard')

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')

@if ($countService > 0)
<div class="row">
      <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-warning o-hidden">
                  <div class="card-body">
                        <div class="card-body-icon">
                              <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="mr-5">
                              <h5>@if ($countReview > 0){{$countReview}}@else No @endif New Reviews!</h5>
                        </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.reviews.index')}}">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                              <i class="fa fa-angle-right"></i>
                        </span>
                  </a>
            </div>
      </div>
      <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-success  o-hidden">
                  <div class="card-body">
                        <div class="card-body-icon">
                              <i class="fa fa-fw fa-calendar-check-o"></i>
                        </div>
                        <div class="mr-5">
                              <h5>@if ($countOrder > 0){{$countOrder}}@else No @endif New Bookings!</h5>
                        </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.orders.index')}}">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                              <i class="fa fa-angle-right"></i>
                        </span>
                  </a>
            </div>
      </div>
      <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card dashboard text-white bg-danger o-hidden">
                  <div class="card-body">
                        <div class="card-body-icon">
                              <i class="fa fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5">
                              <h5>@if ($countService > 0){{$countService}}@else No @endif Services</h5>
                        </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="{{ route('clients.services.index')}}">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                              <i class="fa fa-angle-right"></i>
                        </span>
                  </a>
            </div>
      </div>
</div>
@else
<div id="clientdashboard" class="box_general box padding_bottom text-center">
      <div class="row h-100">
            <div class="col-sm-12 my-auto">
                  <div class="mx-auto">
                        <div class="align-middle">
                              <span class="font-weight-bolder text-dark font-large-30 ">You haven't add any service
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
@endif
@endsection