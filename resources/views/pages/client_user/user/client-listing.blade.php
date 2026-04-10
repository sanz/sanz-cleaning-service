@extends('layouts.client_user.contentLayoutMaster')

@section('title','Client Listing')

@section('specific-style')
  <link href="{{asset('client_user/css/listing.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in clearfix')

@section('content')
  <main class="bg_color">

    <div class="filters_full element_to_stick">
      <div class="container clearfix d-inline-flex d-md-block">
        <div class="sort_select mr-1 w-auto">
          <select name="SL_service" id="SL_service" class="form-control">
            <option value="{{route('customers.clients.index')}}" @if ($selectId == "")
              selected
            @endif>all</option>
            @foreach ($catalogs as $catalog)
            <option value="{{route('customers.clients.filter',['id'=>$catalog->id])}}" @if ($selectId == $catalog->id)
              selected
            @endif>{{$catalog->service_name}}</option>
            @endforeach
          </select>
        </div>
        <a href="#collapseFilters" data-toggle="collapse" class="btn_filters dor"><i class="icon_adjust-vert"></i><span>Filters</span></a>
        <div class="search_bar_list">
          <input type="text" class="form-control search-input" placeholder="Search again...">
        </div>
        <a class="btn_search_mobile btn_filters" data-toggle="collapse" href="#collapseSearch"><i
            class="icon_search"></i></a>
      </div>
      <div class="collapse filters_2" id="collapseFilters">
        <div class="container margin_detail">
          <div class="row">
            <div class="col-12">
              <div class="filter_type">
                <h6>Rating</h6>
                <ul>
                  <li class="list-inline-item float-sm-none float-left">
                    <label class="container_check">Superb 4+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-right">
                    <label class="container_check">Very Good 3+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-left">
                    <label class="container_check">Good 2+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-right rate-mr-3_75">
                    <label class="container_check">Pleasant 1+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
      <!-- /filters -->
      <div class="collapse" id="collapseSearch">
        <div class="search_bar_list">
          <input type="text" class="form-control search-input" placeholder="Search again...">
        </div>
      </div>
      <!-- /collapseSearch -->
    </div>
    <!-- /filters_full -->

    <div class="container margin_30_40">
      <div class="page_header">
        <span></span>
      </div>
      <!-- /page_header -->
      <div id="search-content" class="row">
        @foreach ($services as $service)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset($service->photo)}}"
                   data-src="{{asset($service->photo)}}" class="img-fluid lazy" alt="">
              <a href="{{route('customers.clients.show',['id'=>$service->service_id])}}" class="strip_info">
                <div class="item_title">
                  <h3>{{$service->name}}</h3>
                  <small>{{$service->service_name}}</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="{{$service->experience}} experiance"><i class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="{{$service->address}}">{{$service->city}}</i></a></li>
              <li>
                @php
                $revSum = round((round($service->response_rating,1)+round($service->service_rating,1)+round($service->communication_rating,1)+round($service->price_rating,1))/4,1);
                @endphp
                <div class="score"><span>
                  @if ($revSum>=4)
                  superb
                  @elseif ($revSum>=3)
                  Very Good
                  @elseif ($revSum>=2)
                  Good
                  @elseif ($revSum>=1)
                  Pleasant
                  @elseif ($revSum<1)
                  Noob
                  @endif
                  <em>{{$service->revCount}} Reviews</em></span><strong>{{$revSum}}</strong></div>
              </li>
            </ul>
          </div>
        </div>
        @endforeach

      </div>
      <!-- /row -->
      <div class="pagination_div">
        {{ $services->links() }}
      </div>

    </div>
    <!-- /container -->

  </main>
  <!-- /main -->

@endsection

@section('specific-script')
  <script src="{{asset('client_user/js/sticky_sidebar.min.js')}}"></script>
  <script src="{{asset('client_user/js/specific_listing.min.js')}}"></script>
@endsection
<!-- SPECIFIC SCRIPTS -->

@section('page-script')
  <script src="{{asset('client_user/user/scripts/client-listing.js')}}"></script>
@endsection


