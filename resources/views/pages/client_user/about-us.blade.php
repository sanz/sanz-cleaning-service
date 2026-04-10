@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'About Us')

@section('specific-style')
<link href="{{asset('client_user/css/contacts.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')

@section('content')
<main>

  <div class="">
    <div class="container-fluid margin_60_40">
      <div class="main_title center add_bottom_10">
        <span><em></em></span>
        <h2 class="font-weight-bolder">Our Story</h2>
      </div>
      <div class="row  how_2">
        <div class="col-lg-7">
          <div class="rich-text m-4 text-justify">
            <p>
              Strong customer relationships are more important than ever, but the scale and nature of online business
              means it's harder than ever to create personal connections with customers.
            </p>
            <p>
              That's why we created the world's first Conversational Relationship Platform - to help businesses build
              better customer relationships through personalized, messenger-based experiences.
            </p>
          </div>
        </div>
        <div class="col-lg-5 m-auto">
          <div id="story-img" class="background-image" data-background="url({{asset('client_user/img/about-1.svg')}})">
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
  </div>
  </div>
  <!-- /container -->

  <div class="bg_gray">
    <div class="container margin_60_40">
      <div class="main_title center">
        <span><em></em></span>
        <h2>Why Sanz</h2>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="box_why  text-center">
            <figure><img src="{{asset('client_user/img/why_1.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Boost your Visibility</h3>
            <p class="lead">Increase your business by using Sanz and get more benifits.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_why  text-center">
            <figure><img src="{{asset('client_user/img/why_2.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Manage Easily</h3>
            <p class="lead">Easy to manage your business by online website platform and connect to customers very
              easily.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_why text-center">
            <figure><img src="{{asset('client_user/img/why_3.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Reach New Customers</h3>
            <p class="lead">Connect to more customers and expand your business by online platform.</p>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /bg_gray -->

  <div>
    <div class="container margin_60_40">
      <div class="main_title center add_bottom_10">
        <span><em></em></span>
        <h2 class="font-weight-bolder">Helping Small Business Owners Run Their Businesses</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-4 hovering-zoom">
          <div class="box_contacts font-weight-bolder">
            <div class="rich-text">Over</div>
            <strong class="font-large-50">50+</strong>
            <div class="rich-text">Clients Joined With Us</div>
          </div>
        </div>
        <div class="col-lg-4 hovering-zoom">
          <div class="box_contacts font-weight-bolder">
            <div class="rich-text">Over</div>
            <strong class="font-large-50">100+</strong>
            <div class="rich-text">People Have Used Sanz</div>
          </div>
        </div>
        <div class="col-lg-4 hovering-zoom">
          <div class="box_contacts font-weight-bolder">
            <div class="rich-text">We Serve Customers In</div>
            <strong class="font-large-50">5+</strong>
            <div class="rich-text">Cities</div>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
  </div>
  <!-- /container -->

</main>
<!-- /main -->
@endsection