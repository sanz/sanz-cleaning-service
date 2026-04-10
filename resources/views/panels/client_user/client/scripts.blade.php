<!-- Bootstrap core JavaScript-->
<script src="{{asset('client_user/client/jquery/jquery.min.js')}}"></script>
<script src="{{asset('client_user/client/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('js/scripts/HoldOn/HoldOn.min.js') }}"></script>
<script src="{{ asset('js/scripts/HoldOn/runHoldOn.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('client_user/client/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Page level plugin JavaScript-->

<script src="{{asset('vendors/js/charts/Chart.min.js')}}"></script>
<script src="{{asset('client_user/client/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('client_user/client/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('client_user/client/js/jquery.selectbox-0.2.js')}}"></script>
<script src="{{asset('client_user/client/js/retina-replace.min.js')}}"></script>
<script src="{{asset('client_user/client/js/jquery.magnific-popup.min.js')}}"></script>
{{-- page script --}}
@yield('page-script')

<!-- Custom scripts for all pages-->
<script src="{{asset('client_user/client/js/admin.js')}}"></script>
<!-- Custom scripts for this page-->
{{-- custom Scripts --}}
@yield('custom-script')

