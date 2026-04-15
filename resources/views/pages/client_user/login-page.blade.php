@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'Login Page')

@section('specific-style')
<link href="{{ asset('client_user/css/detail-page.css') }}" rel="stylesheet">
<link href="{{asset('client_user/css/submit.css')}}" rel="stylesheet">
<link href="{{asset('client_user/css/account.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')

@section('header')
@include('panels.client_user.header')
@endsection

@section('content')
<div id="login-modal" class="bg_gray pattern_mail">
      <div class="container-fluid d-flex h-100 align-items-center justify-content-center">
            <div>
                  <div id="login" class="align-content-center bg-transparent">
                        <div class="box_general padding">
                              <div class="radio_select type">
                                    <ul>
                                          <li class="w-49">
                                                <a id="radio_user" name="radio_user">
                                                      <label for="radio_user" class="selected"> <i
                                                                  class="icon-users"></i> User</label>
                                                </a>
                                          </li>
                                          <li class="w-49">
                                                <a id="radio_client" name="radio_client">
                                                      <label for="radio_client"><i
                                                                  class="fa fa-users pb-1"></i>Client</label>
                                                </a>
                                          </li>
                                    </ul>
                              </div>

                              <form id="login-form" method="POST" class="mt-3" action="@if ($errors->all() && session()->has('passlink'))
                                                            {{session()->get('passlink')}}
                                                            @else
                                                            {{route('auth.customers.login')}}
                                                            @endif">
                                    @csrf
                                    <div class="main_title center">
                                          <p>Login as a Customer</p>
                                    </div>
                                    <div class="form-group">
                                          <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" value="{{ old('email') }}" required
                                                placeholder="Email">
                                          <i class="icon_mail_alt"></i>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                          <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" required placeholder="Password">
                                          <span toggle="#password"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                          <i class="icon_lock_alt"></i>
                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                    </div>
                                    <div class="clearfix add_bottom_30">
                                          <div class="checkboxes float-left">
                                                <label class="container_check">Remember me
                                                      <input type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                      <span class="checkmark"></span>
                                                </label>
                                          </div>
                                          <div class="float-right"><a id="forgot"
                                                      href="{{ route('auth.customers.password.request') }}">Forgot
                                                      Password?</a></div>
                                    </div>
                                    <button type="submit" class="btn_1 full-width">Login</button>
                                    <div class="text-center add_top_10">New to Sanz? <strong><a
                                                      href="{{route('auth.customers.register')}}">Sign up!</a></strong></div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>
<!-- /container -->
@endsection

@section('page-script')
<script src="{{ asset('client_user/js/UI/login-page.js') }}"></script>
@endsection