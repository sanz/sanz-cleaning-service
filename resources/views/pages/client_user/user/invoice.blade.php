@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Invoice')

@section('specific-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/invoice.css')) }}">
<link href="{{ asset('client_user/css/booking-sign_up.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')

<main class="bg_gray pattern">
    <div class="container margin_60_40">
        <div class="col justify-content-center">
            <section class="invoice-print mb-2">
                <div class="row">
                    <div class="col-12">
                        <div id="editor"></div>
                        <button class="btn_1 btn-print float-right mb-1 mb-md-0 ml-1"> <i class="fa fa-print mr-1"></i>Print</button>
                    </div>
                </div>
            </section>
            <!-- invoice functionality end -->
            <section class="card invoice-page" id="customers.orders.invoice">
                <div id="invoice-template" class="card-body">
                    <!-- Invoice Company Details -->
                    <div id="invoice-company-details" class="row">
                        <div class="col-md-6 col-sm-12 text-left pt-1">
                            <div class="media pt-1">
                                <img src="{{asset('client_user/img/logo.png')}}" width="150" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <h1>Invoice</h1>
                            <div class="invoice-details mt-2">
                                <h6>INVOICE NO.</h6>
                                <div class="font-large-17 font-weight-bold">{{$data["invoice_no"]}}</div>
                                <h6 class="mt-2">INVOICE DATE</h6>
                                <div class="font-large-17 font-weight-bold">{{$data["invoice_date"]}}</div>
                            </div>
                        </div>
                    </div>
                    <!--/ Invoice Company Details -->
                    <hr>
                    <!-- Invoice Recipient Details -->
                    <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-sm-6 col-12 text-left">
                            <h5>Recipient</h5>
                            <div class="recipient-info my-2">
                                <p>{{$data["user_name"]}}</p>
                                <address>{{$data["user_address"]}}</address>
                            </div>
                            <div class="recipient-contact pb-2">
                                <p>
                                    <a href="mailto:{{$data["user_email"]}}"><i class="fa fa-envelope mr-1"></i>{{$data["user_email"]}}</a>
                                </p>
                                <p>
                                    <a href="tel:+91{{$data["user_phone"]}}"><i class="fa fa-phone-square mr-1"></i>+91-{{$data["user_phone"]}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-right">
                            <h5>{{$data["service_name"]}}</h5>
                            <div class="company-info my-2">
                                <address>{!! $data["service_address"] !!}</address>
                            </div>
                            <div class="company-contact">
                                <p>
                                    <a href="mailto:{{$data["client_email"]}}"><i class="fa fa-envelope mr-1"></i>{{$data["client_email"]}}</a>
                                </p>
                                <p>
                                    <a href="tel:+91{{$data["client_phone"]}}"><i class="fa fa-phone-square mr-1"></i>+91-{{$data["client_phone"]}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/ Invoice Recipient Details -->

                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-1 invoice-items-table">
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>TASK DESCRIPTION</th>
                                            <th class="text-center">AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data["items"] as $item)
                                            <tr>
                                                <td>{{$item["name"]}}</td>
                                                <td class="text-center font-large-17 font-weight-bold">$CA {{$item["item_price"]}} /-</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="invoice-total-details" class="invoice-total-table">
                        <div class="row">
                            <div class="col-4 offset-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>SUBTOTAL:</th>
                                                <th><h5>$CA {{$data["total_amount"]}} /-</h5></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection

@section('page-script')
    <script src="{{asset("client_user/js/UI/html2pdf.js")}}"></script>
    <script src="{{ asset(mix('js/scripts/pages/invoice.js')) }}"></script>
@endsection
