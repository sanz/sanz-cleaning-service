@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Client Detail')

@section('specific-style')
<link href="{{ asset('client_user/css/detail-page.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')

@section('content')
<main class="bg_color">
    <div class="container margin_detail">
        @if ($errors->first())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{session('msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="box_general">
                    <div class="d-none d-sm-block">
                        <div class="image-set-auto background-image"
                            data-background="url({{asset($service->photo)}})"></div>
                    </div>
                    <div class="main_info_wrapper">
                        <div class="main_info clearfix">
                            <div class="user_thumb">
                                <figure><img src="{{asset($service->client_photo_url)}}" alt=""></figure>
                                <em class="{{$service->status == "Active"?"online":"offline"}}"><span></span>{{$service->status == "Active"?"Available":"Not Available"}}</em>
                            </div>
                            <div class="user_desc">
                                <h3>{{$service->name}}</h3>
                                <p>{{$service->city}}
                                </p>
                                <ul class="tags">
                                    <li><a>{{$service->service_name}}</a></li>
                                </ul>
                            </div>
                            <div class="score_in">
                                <div class="rating">
                                    @php
                                    $revSum =
                                    round((round($avg->response_rating,1)+round($avg->service_rating,1)+round($avg->communication_rating,1)+round($avg->price_rating,1))/4,1);
                                    @endphp
                                    <div class="score"><span>
                                            @if ($revSum>=4)
                                            Superb
                                            @elseif ($revSum>=3)
                                            Very Good
                                            @elseif ($revSum>=2)
                                            Good
                                            @elseif ($revSum>=1)
                                            Pleasant
                                            @elseif ($revSum<1) Decent @endif <em>{{count($reviews)}}
                                                Reviews</em></span><strong>{{$revSum}}</strong></div>
                                </div>
                            </div>
                        </div>
                        <!-- /main_info_wrapper -->


                    </div>
                    <!-- /main_info -->
                </div>
                <!-- /box_general -->
                <div class="box_general">
                    <div class="tabs_detail">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Other
                                    info</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content" role="tablist">
                            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel"
                                aria-labelledby="tab-A">
                                <div class="card-header" role="tab" id="heading-A">
                                    <h5>
                                        <a class="collapsed" data-toggle="collapse" href="#collapse-A"
                                            aria-expanded="true" aria-controls="collapse-A">
                                            Other info
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                                    <div class="card-body info_content">
                                        <div class="indent_title_in">
                                            <i class="icon_document_alt"></i>
                                            <h3>Services</h3>
                                        </div>
                                        <div class="wrapper_indent">
                                            {{-- <p>{{$service->description}}</p> --}}
                                            {!!$service->description!!}
                                            <h6>Service Items</h6>
                                            <div class="services_list clearfix">
                                                <ul>
                                                    @foreach ($items as $item)
                                                    <li>
                                                        <div>
                                                            <div>{{$item->name}} <strong><small>from</small>
                                                                    $CA{{$item->item_price}}</strong>
                                                            </div>
                                                            <div>
                                                                <small>{{$item->description}}</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!--  End wrapper indent -->
                                    </div>
                                </div>
                            </div>
                            <!-- /tab -->
                            <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                                <div class="card-header" role="tab" id="heading-B">
                                    <h5>
                                        <a class="collapsed" data-toggle="collapse" href="#collapse-B"
                                            aria-expanded="false" aria-controls="collapse-B">
                                            Reviews
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                                    <div class="card-body reviews">
                                        <div class="row add_bottom_45 d-flex align-items-center">
                                            <div class="col-md-3">
                                                <div id="review_summary">
                                                    @php
                                                    $revSum =
                                                    round((round($avg->response_rating,1)+round($avg->service_rating,1)+round($avg->communication_rating,1)+round($avg->price_rating,1))/4,1);
                                                    @endphp
                                                    <strong>{{$revSum}}</strong>
                                                    <em>
                                                        @if ($revSum>=4)
                                                        Superb
                                                        @elseif ($revSum>=3)
                                                        Very Good
                                                        @elseif ($revSum>=2)
                                                        Good
                                                        @elseif ($revSum>=1)
                                                        Pleasant
                                                        @elseif ($revSum<1) Decent @endif </em> <small>Based on
                                                            {{count($reviews)}} reviews</small>
                                                </div>
                                            </div>
                                            <div class="col-md-9 reviews_sum_details">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Response time</h6>
                                                        <div class="row">
                                                            <div class="col-xl-10 col-lg-9 col-9">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{ (round($avg->response_rating,2)/5)*100 }}%"
                                                                        aria-valuenow="{{(round($avg->response_rating,2)/5)*100}}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-3">
                                                                <strong>{{round($avg->response_rating,2)}}</strong>
                                                            </div>
                                                        </div>
                                                        <!-- /row -->
                                                        <h6>Service</h6>
                                                        <div class="row">
                                                            <div class="col-xl-10 col-lg-9 col-9">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{ (round($avg->service_rating,2)/5)*100 }}%"
                                                                        aria-valuenow="{{ (round($avg->service_rating,2)/5)*100 }}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-3">
                                                                <strong>{{round($avg->service_rating,2)}}</strong>
                                                            </div>
                                                        </div>
                                                        <!-- /row -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Communication</h6>
                                                        <div class="row">
                                                            <div class="col-xl-10 col-lg-9 col-9">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{(round($avg->communication_rating,2)/5)*100}}%"
                                                                        aria-valuenow="{{(round($avg->communication_rating,2)/5)*100}}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-3">
                                                                <strong>{{round($avg->communication_rating,2)}}</strong>
                                                            </div>
                                                        </div>
                                                        <!-- /row -->
                                                        <h6>Price</h6>
                                                        <div class="row">
                                                            <div class="col-xl-10 col-lg-9 col-9">
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                        style="width: {{(round($avg->price_rating,2)/5)*100}}%"
                                                                        aria-valuenow="{{(round($avg->price_rating,2)/5)*100}}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-2 col-lg-3 col-3">
                                                                <strong>{{round($avg->price_rating,2)}}</strong>
                                                            </div>
                                                        </div>
                                                        <!-- /row -->
                                                    </div>
                                                </div>
                                                <!-- /row -->
                                            </div>
                                        </div>
                                        @foreach ($reviews as $review)

                                        <div id="reviews">
                                            <div class="review_card">
                                                <div class="row">
                                                    <div class="col-md-2 user_info">
                                                        <figure><img src="{{asset('client_user/img/avatar.jpg')}}"
                                                                alt=""></figure>
                                                        <h5>{{$review->user_name}}</h5>
                                                    </div>
                                                    <div class="col-md-10 review_content">
                                                        <div class="clearfix add_bottom_15">
                                                            <span
                                                                class="rating">{{round(($review->response_rating+$review->service_rating+$review->communication_rating+$review->price_rating)/4,1)}}<small>/5</small>
                                                                <strong>Rating
                                                                    average</strong></span>
                                                            <em>Published On
                                                                {{date_format(date_create($review->created_at),"M d Y")}}</em>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <h4>{{ $review->title }}</h4>
                                                                <p>{{ $review->feedback }}</p>
                                                            </div>
                                                            @if ($review->image)
                                                            <div class="col-md-4">
                                                                <img class="border float-md-right"
                                                                    src="{{asset('storage/'.$review->image)}}"
                                                                    height="130px" width="130px">
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /row -->
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- /reviews -->
                                        @if (Auth::guard('customer')->check())
                                        <p class="text-right"><a
                                            href="{{route('customers.reviews.show',['id'=>$service->service_id])}}"
                                                class="btn_1">
                                                @if ($usrReview)
                                                Edit Your review
                                                @else
                                                Leave a review
                                                @endif
                                            </a></p>

                                        @else
                                        <p class="text-right"><a href="{{route('auth.login')}}" class="btn_1">Login to
                                                write Review</a></p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tab-content -->
                    </div>
                    <!-- /tabs_detail -->
                </div>
            </div>
            <!-- /col -->
            <div class="col-xl-4 col-lg-5" id="sidebar_fixed">
                <div class="box_booking mobile_fixed">
                    <div class="head">
                        <h3>Booking</h3>
                        <a href="#0" class="close_panel_mobile"><i class="icon_close"></i></a>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <form id="placeorderform" method="POST" action="
                        {{route('customers.orders.book',['id'=>$service->service_id])}}
                        ">
                            @csrf
                            <input type="text" id="datepicker_field" name="date">
                            <div id="DatePicker"></div>
                            <div class="dropdown time mb-4">
                                <a href="#" data-toggle="dropdown">Select Preferred Time: <input type="text" readonly class="border-0"
                                        id="selected_time" name="selected_time"></a>

                                <div class="dropdown-menu ">
                                    <div class="dropdown-menu-content">
                                        <div class="radio_select">
                                            <div class="row">
                                                <span class="col-6">
                                                    <input type="radio" id="time_1" name="time"
                                                        value="10:00am - 12:00pm"><label
                                                        for="time_1">10:00<small>pm</small>
                                                        - 12:00<small>pm</small></label>
                                                </span>
                                                <span class="col-6">
                                                    <input type="radio" id="time_2" name="time"
                                                        value="12:00pm - 02:00pm"><label
                                                        for="time_2">12:00<small>pm</small>
                                                        - 02:00<small>pm</small></label>
                                                </span>
                                                <span class="col-6">
                                                    <input type="radio" id="time_3" name="time"
                                                        value="02:00-pm - 04:00pm"><label
                                                        for="time_3">02:00<small>pm</small> -
                                                        04:00<small>pm</small></label>
                                                </span>
                                                <span class="col-6">
                                                    <input type="radio" id="time_4" name="time"
                                                        value="04:00pm - 06:00pm"><label
                                                        for="time_4">04:00<small>pm</small>
                                                        - 06:00<small>pm</small></label>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- /time_select -->
                                    </div>
                                </div>
                            </div>

                            <!-- /dropdown -->
                            <div class="mb-3">
                                <div>
                                    <label class="font-weight-bolder mb-0 font-large-20">Select Service Items</label>
                                </div>
                                <div class="services_list clearfix">
                                    <ul>
                                        @foreach ($items as $item)
                                        <li><input type="checkbox" name="services[]" class="mr-2"
                                                value="{{$item->item_id}}"><label
                                                for="ser_1">{{$item->name}}
                                            </label><strong><small>from</small> $CA{{$item->item_price}}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="error_message"></div>

                            @if (Auth::guard('customer')->check())
                            <button type="submit" id="plc_oder_btn" class="btn_1 full-width booking">Book Now</button>
                            @else
                            <a href="{{route('auth.login')}}" class="btn_1 full-width booking">Login Now to Book</a>
                            @endif

                        </form>
                    </div>
                </div>
                <!-- /box_booking -->
                @if (Auth::guard('customer')->check())
                <div class="btn_reserve_fixed"><a href="#0" class="btn_1 full-width booking">Book Now</a></div>
                @else
                <div class="btn_reserve_fixed"><a href="{{route('auth.login')}}" class="btn_1 full-width booking">Login
                        Now to Book</a></div>
                @endif
                {{-- <div class="btn_reserve_fixed"><a href="#0" class="btn_1 full-width booking">Book Now</a></div> --}}
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!-- /main -->
@endsection

@section('specific-script')
<script src="{{ asset('client_user/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('client_user/js/specific_detail.js') }}"></script>
<script src="{{ asset('client_user/js/datepicker.min.js') }}"></script>
<script src="{{ asset('client_user/js/datepicker_func_1.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('client_user/user/scripts/client-detail.js') }}"></script>
@endsection
