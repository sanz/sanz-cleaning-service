@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'Forgot Password')

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
                              <form id="forgot-passwd-form" action="{{route('auth.customers.password.email')}}" method="POST"
                                    class="mt-3" action="">
                                    @csrf
                                    <div class="main_title center">
                                          <p>Recover your password</p>
                                    </div>
                                    <p>Please enter your email address and we'll send you instructions on how to reset
                                          your password.</p>
                                    <div class="form-group">
                                          @if (! session('status'))
                                          <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="user_email" id="email" value="{{ old('email') }}" required
                                                placeholder="Email">
                                          <i class="icon_mail_alt"></i>
                                          @else
                                          <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                          </div>
                                          @endif
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                    </div>
                                    <div class="mt-5 mt-sm-4">
                                          @if (! session('status'))
                                          <button type="submit" class="btn_1 full-width float-right">Recover
                                                Password</button>
                                          @endif
                                          <a href="{{ route('auth.login') }}"
                                                class="btn_1 mt-2 outline full-width float-left">Back to Login</a>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection