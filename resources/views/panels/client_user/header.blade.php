<!-- BEGIN: Header-->
<header class="@yield('header-class')">
  <div class="container-fluid">
    <div id="logo">
      <a href="{{route('home')}}">
        <img id="logo_normal" src="{{asset('client_user/img/logo.png')}}" width="150" height="100"  alt="" class="logo">
      </a>
    </div>  

    @if ( ! str_contains(Request::fullUrl(), 'login'))
      @if (Auth::guard('customer')->check())
    <ul id="top_menu" class="drop_user">
      <li>
        <div class="dropdown user clearfix min-width-100px">
          <a href="#" data-toggle="dropdown" class="float-right">
            <figure><img src="{{ asset('images/default-img/user.png') }}" alt=""></figure><span class="d-md-inline-block d-none">{{Auth::guard('customer')->user()->user_code}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-max-content">
            <div class="dropdown-menu-content">
              <ul>
                <li><a href="{{ route('customers.profile.show') }}"><i class="icon_cog"></i>Profile</a></li>
                <li><a href="{{ route('customers.orders.index') }}"><i class="icon_document"></i>Bookings</a></li>

                {{-- Comming Soon in Update --}}
                {{-- <li><a href="#0"><i class="icon_mail"></i>Messages</a></li> --}}
                <li>
                  <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link p-0"><i class="icon_key"></i>Log out</button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /dropdown -->
      </li>
    </ul>
    @else
    <ul id="top_menu">
      <li><a id="sign-in" class="btn_access" href="{{route('auth.login')}}">Sign In</a></li>
      <li><a href="{{route('auth.clients.register')}}" class="btn_access green">Join Free</a></li>
    </ul>
    @endif
    @endif

    @yield('top_menu_content')

    <!-- /top_menu -->
    <!-- /top_menu -->
    <a href="#0" class="open_close">
      <i class="icon_menu"></i><span>Menu</span>
    </a>
    <nav class="main-menu">
      <div id="header_menu">
        <a href="#0" class="open_close">
          <i class="icon_close"></i><span>Menu</span>
        </a>
        <a href="{{route('home')}}"><img src="{{asset('client_user/img/logo.png')}}" width="150" height="35"
            alt=""></a>
      </div>
      <ul>
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('pages.about')}}">About Us</a></li>
        <li><a href="{{route('pages.contact')}}">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>
<!-- END: Header-->