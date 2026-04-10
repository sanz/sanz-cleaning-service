      {{-- base js --}}
      <script src="{{asset('client_user/js/common_scripts.min.js')}}"></script>
      <script src="{{asset('client_user/js/common_func.js')}}"></script>
      <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
      <script src="{{asset('client_user/assets/validate.js')}}"></script>
        {{-- specific Scripts --}}
        @yield('specific-script')

        {{-- page script --}}
        @yield('page-script')

        {{-- custom Scripts --}}
        @yield('custom-script')
