@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Confirm Order')

@section('specific-style')
<link href="{{ asset('client_user/css/booking-sign_up.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')
<main class="bg_gray pattern">
  @if ($errors->first())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
    <div class="container margin_60_40">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-8">
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                            <h3>{{$service->name}}</h3><span>{{$service->address}}, {{$service->city}}, {{$service->state}} - {{$service->pincode}}</span>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <div id="switch1">
                            <form id="cnfm-od-form" method="POST" action="{{route('customers.orders.confirm.store',['id'=>$service->service_id])}}">
                                <section id="switch_inner2">
                                  @csrf
                                    <div class="mb-3">
                                        <h6>Work Location details</h6>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control" name="state" id="cnfod_state">
                                                  <option value="{{$service->state}}" selected>{{$service->state}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <select name="city" id="cnfod_city" class="form-control">
                                                    <option value="{{$service->city}}" selected>{{$service->city}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->address_1}}" id="cnfod_ad1" name="address1"
                                                    placeholder="*Address 1">
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->address_2}}" id="cnfod_ad2" name="address2"
                                                    placeholder="*Address 2 (Optional)">
                                            </div>
                                            <div class="form-group col-6">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->user_pincode}}" placeholder="*Pincode"
                                                    id="cnfod_pin" name="pincode">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="BO_btn2" type="button" class="btn_1 full-width mb_5">Confirm
                                            Order</button>
                                    </div>
                                </section>
                                <section id="switch_inner3" hidden>
                                    <div class="mb-4">
                                        <h6>Booking summary</h6>
                                        <ul>
                                            <li>Date<span>{{Cookie::get('date')}}</span></li>
                                            <li>Time Slot<span>{{Cookie::get('selected_time')}}</span></li>
                                            <li>Category<span>{{ucfirst($service->service_category)}}</span></li>
                                            <li>Service<span>{{ucfirst($service->service_name)}}</span></li>
                                        </ul>
                                        <hr>
                                        <h6>Work Location Details</h6>
                                        <ul>
                                            <li>Address Line 1<span class="s_address1"></span></li>
                                            <li>Address Line 2<span class="s_address2"></span></li>
                                            <li>City<span class="s_city"></span></li>
                                            <li>State<span class="s_state"></span></li>
                                            <li>Pincode<span class="s_pin"></span></li>
                                        </ul>
                                        <hr>
                                        <h6>Service Item Details</h6>
                                        <ol>
                                          @php
                                          $total=0
                                          @endphp
                                          @foreach ($items as $item)
                                          @php
                                            $total = (int)$total + (int)$item->item_price;
                                          @endphp
                                          <li><label> {{$item->name}}</label><label class="float-right"> {{$item->item_price}} $CA</label></li>
                                          @endforeach
                                            </li>
                                        </ol>

                                        <ul class="pb-4">
                                            <li><span class="float-right border-top"><label
                                                        class="font-weight-bolder">Grand
                                                        Total:</label> <label class="font-weight-bolder ml-3"> {{$total}}
                                                        $CA</label></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button id="BO_btn3" type="submit" class="btn_1 full-width mb_5">Book
                                            Now</button>
                                    </div>
                                </section>

                                <a href="{{ url()->previous()}}" class="btn_1 full-width outline mb_25">Change
                                    Booking</a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /box_booking -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection

@section('page-script')
<script src="{{ asset('client_user/user/scripts/user-confirm-order.js') }}"></script>
@endsection
