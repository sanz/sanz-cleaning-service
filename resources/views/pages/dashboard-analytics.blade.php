@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/pages/dashboard-analytics.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/pages/card-analytics.css')) }}">
<link rel="stylesheet" href="{{ asset('css/custom/custom.css') }}">
@endsection

@section('content')
{{-- Dashboard Analytics Start --}}
<section id="dashboard-analytics">
  <div class="row">
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700">{{$countClient}}</h2>
            <p>Client Joined</p>
          </div>
          <div class="avatar bg-rgba-primary p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-users text-primary font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700">{{$countUser}}</h2>
            <p>Active Users</p>
          </div>
          <div class="avatar bg-rgba-success p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-user-check text-success font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700">{{$countOrder}}</h2>
            <p>Orders Received</p>
          </div>
          <div class="avatar bg-rgba-danger p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-package text-danger font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header d-flex align-items-start pb-0">
          <div>
            <h2 class="text-bold-700">{{$countReview}}</h2>
            <p>Reviews Received</p>
          </div>
          <div class="avatar bg-rgba-warning p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-award text-warning font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if ($countOrder > 0)
  <div class="row match-height">
    <div class="offset-lg-2 col-lg-8 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <h4>Product Orders</h4>
        </div>
        <div class="card-content">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-sm-8 col-12">
                <div id="product-order-chart"></div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="chart-info d-flex justify-content-between mb-1">
                  <div class="series-info d-flex align-items-center">
                    <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                    <span class="text-bold-600 ml-50">Finished</span>
                  </div>
                  <div class="product-result">
                    <span class="od_finish"></span>
                  </div>
                </div>
                <div class="chart-info d-flex justify-content-between mb-1">
                  <div class="series-info d-flex align-items-center">
                    <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                    <span class="text-bold-600 ml-50">Pending</span>
                  </div>
                  <div class="product-result">
                    <span class="od_pending"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
@endsection