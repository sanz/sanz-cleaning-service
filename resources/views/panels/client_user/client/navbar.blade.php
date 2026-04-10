<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <link rel="shortcut icon" href="{{asset('client_user/img/favicon.svg')}}" type="image/x-icon">
  <a class="navbar-brand mr-4" href="{{route('clients.dashboard')}}"><img class="width-logo-auto" src="{{asset('client_user/img/logo.png')}}"
      data-retina="true" alt="" width="120" height="35"></a>

  <span class="nav-item dropdown d-lg-none d-md-block">
    <a class="nav-link dropdown-toggle mr-lg-2 link-color logo-a" id="clientDropdown1" href="#" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <span class="logo-figure"><img class="logo-img"
          src="{{Auth::guard('client')->user()->client_photo_url}}"
          alt=""></span><span class="d-none d-sm-inline-block">{{Auth::guard('client')->user()->client_code}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-min-auto" aria-labelledby="clientDropdown1">
      <a class="nav-link text-black-50" href="#exampleModal" data-toggle="modal">
        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
    </div>
  </span>

  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{route('clients.dashboard')}}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
        <a class="nav-link" href="{{route('clients.profile.index')}}">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">My Profile</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Service Listings">
        <a class="nav-link" href="{{route('clients.services.index')}}">
          <i class="fa fa-fw fa-list"></i>
          <span class="nav-link-text">Service Listings</span>
          {{-- <span class="badge badge-pill badge-warning text-secondary">6</span> --}}
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Orders"
        data-original-title="Manage Orders">
        <a class="nav-link" href="{{route('clients.orders.index')}}">
          <i class="fa fa-fw fa-calendar-check-o"></i>
          <span class="nav-link-text">Manage Orders</span>
          @isset($countOrderManage)
            <span class="badge badge-pill badge-primary">{{$countOrderManage}}</span>
            @endisset
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
        <a class="nav-link" href="{{route('clients.reviews.index')}}">
          <i class="fa fa-fw fa-star"></i>
          <span class="nav-link-text">Reviews</span>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown d-lg-block d-none">
        <a class="nav-link dropdown-toggle mr-lg-2 logo-a" id="clientDropdown" href="#" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="logo-figure"><img class="logo-img" src="{{Auth::guard('client')->user()->client_photo_url}}"
              alt=""></span><span class="font-large-17 font-weight-bold"># {{Auth::guard('client')->user()->client_code}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-min" aria-labelledby="clientDropdown">
          <a class="nav-link text-black-50" href="#exampleModal" data-toggle="modal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
