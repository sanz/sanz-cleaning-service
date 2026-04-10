<!-- BEGIN: Footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <h3 data-target="#collapse_1">Quick Links</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_1">
          <ul>
            <li><a href="{{route('auth.clients.register')}}">Join Us</a></li>
            <li><a href="{{route('auth.login')}}">Login</a></li>
            <li><a href="{{route('pages.about')}}">About Us</a></li>
            <li><a href="{{route('pages.contact')}}">Contacts</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <h3 data-target="#collapse_2">Categories</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_2">
          <ul>
            <li><a href="{{route('customers.clients.index')}}">Top Categories</a></li>
            <li><a href="{{route('customers.clients.index')}}">Best Rated</a></li>
            <li><a href="{{route('customers.clients.index')}}">Best Price</a></li>
            <li><a href="{{route('customers.clients.index')}}">Latest Submissions</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 offset-lg-3 col-md-6">
        <h3 data-target="#collapse_4">Keep in touch</h3>
        <div class="collapse dont-collapse-sm" id="collapse_4">
          <div class="follow_us">
            <ul>
              <li><a href="#0"><img src="{{asset('client_user/img/twitter_icon.svg')}}" data-src="{{asset('client_user/img/twitter_icon.svg')}}" alt="" class="lazy"></a></li>
              <li><a href="#0"><img src="{{asset('client_user/img/facebook_icon.svg')}}" data-src="{{asset('client_user/img/facebook_icon.svg')}}" alt="" class="lazy"></a></li>
              <li><a href="#0"><img src="{{asset('client_user/img/instagram_icon.svg')}}" data-src="{{asset('client_user/img/instagram_icon.svg')}}" alt="" class="lazy"></a></li>
              <li><a href="#0"><img src="{{asset('client_user/img/youtube_icon.svg')}}" data-src="{{asset('client_user/img/youtube_icon.svg')}}" alt="" class="lazy"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /row-->
    <hr>
    <div class="row">
      <div class="col-lg-12 text-center">
        <ul class="additional_links float-none">
          <li><a href="#0">Terms and conditions</a></li>
          <li><a href="#0">Privacy</a></li>
          <li><span>© {{date('Y')}} Sanz</span></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    <!-- END: Footer-->
