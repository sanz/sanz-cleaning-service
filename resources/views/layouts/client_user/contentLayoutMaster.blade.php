<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sanz">
  <meta name="author" content="Team Sanz">
  <title>@yield('title') - Sanz</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="{{asset('client_user/img/favicon.svg')}}" type="image/x-icon">
  
  {{-- Include core specific custom Styles --}}
  @include('panels.client_user.styles')

</head>

<body>
{{-- include header --}}
@include('panels.client_user.header')

{{-- include content --}}
<!-- START: Main-->
@yield('content')
<!-- END: Main-->

{{-- include footer --}}
@include('panels.client_user.footer')

<div id="toTop"></div><!-- Back to top button -->

<div class="layer"></div><!-- Opacity Mask Menu Mobile -->

{{-- include scripts --}}
@include('panels.client_user.scripts')

</body>
</html>

