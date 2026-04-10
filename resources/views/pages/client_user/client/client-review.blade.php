@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Review')

@section('page-style')
<link href="{{asset('client_user/client/css/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('client_user/client/css/magnific-popup.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="box_general padding_bottom">
  <div class="header_box">
    <h2 class="d-inline-block">Reviews List</h2>
    {{-- <div class="filter">
        <select name="orderby" class="selectbox">
          <option value="Any time">Any time</option>
          <option value="Latest">Latest</option>
          <option value="Oldest">Oldest</option>
        </select>
      </div> --}}
  </div>
  <div class="list_general reviews">
    <ul class="review-ul">
      @if (!$reviews->first())
      <div class="box_general box padding_bottom text-center">
        <div class="row h-100">
          <div class="col-sm-12 my-auto">
            <div class="mx-auto">
              <div class="align-middle">
                <span class="font-weight-bolder text-dark font-large-30 float-none">You haven't get any Reviews
                  yet!!</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      @foreach ($reviews as $review)
      <li>
        <div class="row">
          <div class="col-sm-9">
            <div class="font-weight-bold font-large-20">{{$review->name}}</div><label class="mb-0"><small>{{$review->service_name}}</small></label>

          </div>
          <div class="col-sm-3">
            <span class="mt-1 mt-sm-0 float-sm-right">on {{date_format(date_create($review->created_at),"M d Y")}}</span>
          </div>
        </div>
        <div class="row mb-4 mb-md-3">
          <div class="col-md-5">
            <div class="font-weight-bold font-large-17 mt-2 mb-10"><small>by</small> {{$review->user_name}}</div>
          </div>
          <div class="col-md-7">
            <div class="row d-flex align-items-center">
              <div class="col-sm-9 reviews_sum_details">
                <div class="row">
                  <div class="col-md-6">
                    <label>Response time</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{(round($review->response_rating,2)/5)*100}}%" aria-valuenow="{{(round($review->response_rating,2)/5)*100}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>{{$review->response_rating}}</strong></div>
                    </div>
                    <!-- /row -->
                    <label>Service</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{(round($review->service_rating,2)/5)*100}}%" aria-valuenow="{{(round($review->service_rating,2)/5)*100}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>{{$review->service_rating}}</strong></div>
                    </div>
                    <!-- /row -->
                  </div>
                  <div class="col-md-6">
                    <label>Communication</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{(round($review->communication_rating,2)/5)*100}}%" aria-valuenow="{{(round($review->communication_rating,2)/5)*100}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>{{$review->communication_rating}}</strong></div>
                    </div>
                    <!-- /row -->
                    <label>Price</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: {{(round($review->price_rating,2)/5)*100}}%" aria-valuenow="{{(round($review->price_rating,2)/5)*100}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>{{$review->price_rating}}</strong></div>
                    </div>
                    <!-- /row -->
                  </div>
                </div>
                <!-- /row -->
              </div>
              <div class="col-sm-3 align-self-center">
                <div id="review_summary">
                  @php
                  $revSum =
                  round((round($review->response_rating,1)+round($review->service_rating,1)+round($review->communication_rating,1)+round($review->price_rating,1))/4,1);
                  @endphp
                  <strong>{{$revSum}}</strong>
                  <em>@if ($revSum>=4)
                    superb
                    @elseif ($revSum>=3)
                    Very Good
                    @elseif ($revSum>=2)
                    Good
                    @elseif ($revSum>=1)
                    Pleasant
                    @elseif ($revSum<1) Noob @endif</em>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <p class="font-weight-bold font-large-17 mb-1">{{$review->title}}</p>
            <div class="mt-0 text-justify">{{$review->feedback}}</div>
          </div>
          @if($review->image)
          <div class="col-md-3 mt-sm-0 mt-15 text-center">
            <img class="img-fluid img-thumbnail float-md-right mb-10 w-auto" src="{{asset('storage/'.$review->image)}}"
              height="130px">
          </div>
          @endif
        </div>
      </li>
      @endforeach
      @endif
    </ul>
  </div>
</div>
{{$reviews->links()}}
@endsection

@section('page-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('client_user/client/js/page-scripts/client-review.js')}}"></script>
@endsection