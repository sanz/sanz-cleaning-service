<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sanz">
  <meta name="author" content="Team Sanz">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - Sanz</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="{{asset('client_user/img/favicon.svg')}}" type="image/x-icon">

{{-- Include core specific custom Styles --}}
@include('panels.client_user.client.styles')

</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
{{-- Include naviation bar --}}
@include('panels.client_user.user.navbar')
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
{{-- Include breadcrumb --}}
      @include('panels.client_user.client.breadcrumb')

{{-- Include Content --}}
@yield('content')

    </div>
    <!-- /.container-fluid-->
  </div>
  <!-- /.container-wrapper-->
{{-- Include footer --}}
  @include('panels.client_user.client.footer')

  <!-- Scroll to Top Button-->
  <a class=" scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- Include core speccific and custom script --}}
@include('panels.client_user.client.scripts')

</body>
</html>


