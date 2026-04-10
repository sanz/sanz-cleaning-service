@extends('layouts.client_user.user-contentLayoutMaster')

@section('title','My Profile')

@section('page-style')
<link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
  @if (session()->has('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Updated!</strong> Your changes saved successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif
  @if ($errors->first())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif

  <div class="row">
    <form id="profile-update-form" action="{{route('customers.profile.update')}}" method="post" autocomplete="off">
      @csrf
    <div class="box_general pb-4">
        <div class="header_box version_2">
          <h2><i class="fa fa-file text-pink"></i>My Profile</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8 pl-0">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group mt-20 mb-0">
                    <span class="small pl-0 mr-2">User Id:</span><span class="font-weight-bold">{{Auth::guard('customer')->user()->user_code}}</span>
                </div>
              </div>
            </div>
            <!-- /row-->

            <div class="row">
              <div class="col-md-8">
                <div class="form-group mt-20">
                  <span class="small pl-0"><label class="required">*</label>Name</span>
                  <input type="text" class="form-control font-weight-bold" id="us_fname" name="user_name" value="{{Auth::guard('customer')
                  ->user()->user_name}}" placeholder="Full Name" >
                </div>
              </div>
            </div>
            <!-- /row-->

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <span class="mr-3 small pl-0"><label class="required">*</label>Gender:</span>
                  <span class="mr-2">
                    <input type="radio" name="user_gender" value="male" @if (Auth::guard('customer')->user()->user_gender =="male")
                    checked
                    @endif  >
                    <label class="font-weight-bold"> Male</label>
                  </span>
                  <span class="mr-2">
                    <input type="radio" name="user_gender" value="female" @if (Auth::guard('customer')->user()->user_gender =="female")
                    checked
                    @endif  >
                    <label> Female</label>
                  </span>
                </div>
              </div>
            </div>
            <!-- /row-->

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <span class="small"><label class="required">*</label>Mobile : </span>
                  <input type="text" name="user_mobile" id="us_mobile" value="{{Auth::guard('customer')->user()->user_mobile}}" class="form-control font-weight-bold" >
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-group">
                  <span class="small"><label class="required">*</label>E-mail : </span>
                  <input type="email" name="user_email" id="us_email" value="{{Auth::guard('customer')->user()->user_email}}" class="form-control font-weight-bold">
                </div>
              </div>
            </div>
            <!-- /row -->

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <span class="mr-3 small pl-0">Address:</span>
                  <div class="row">
                    <div class="form-group col-8 col-md-6">
                      <select class="form-control font-weight-bold h-auto" name="user_state" data-val="{{Auth::guard('customer')->user()->user_state}}" id="us_state">
                        </select>
                    </div>
                    <div class="form-group col-8 col-md-6">
                    <input type="text" class="form-control font-weight-bold" name="user_city"
                        placeholder="City Name" value="{{Auth::guard('customer')->user()->user_city}}">
                    </div>
                    <div class="form-group col-12">
                      <input type="text" class="form-control font-weight-bold" id="us_addl1" name="address_1"
                        placeholder="Address 1" value="{{Auth::guard('customer')->user()->address_1}}">
                    </div>
                    <div class="form-group col-12">
                      <input type="text" class="form-control font-weight-bold" id="us_addl2" name="address_2"
                        placeholder="Address 2 (Optional)" value="{{Auth::guard('customer')->user()->address_2}}">
                    </div>
                    <div class="form-group col-6 col-md-4">
                      <input type="text" class="form-control font-weight-bold" placeholder="Pincode" id="us_pincode"
                        name="user_pincode" value="{{Auth::guard('customer')->user()->user_pincode}}">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /row-->
          </div>

          <div class="col-12 mt-15 form-group">
            <div>
              <span class="font-medium-5">If you want to change password!</span>
              <a id="chngpswdbtn" class="mt-5 text-primary font-weight-bolder" href="javascript:void(0)">change password</a>
            </div>
          </div>
        </div>
    </div>

    <div id="chngepassworddiv" class="box_general pb-md-4  display-hidden">
      <div class="row mt-25">
        <div class="col-12 col-md-4">
          <div class="form-group"><label class="required">*</label>
            <label>Old password</label>
            <i class="fa fa-lock"></i>
            <input id="us_old_pswd" class="form-control" type="password" name="oldpassword" readonly placeholder="Old password">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-group"><label class="required">*</label>
            <label>New password</label>
            <i class="fa fa-lock"></i>
            <input class="form-control new-password" type="password" name="password" readonly placeholder="New password"
              id="us_new_pswd">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-group"><label class="required">*</label>
            <label>Confirm new password</label>
            <input class="form-control cnfm-new-password" type="password" name="password_confirmation" readonly placeholder="Confirm new password" id="us_cnf_new_pswd">
          </div>
        </div>

        <div class="col-12">
          <div class="col-12 text-center">
            <div class="mx-md-15">
              <div id="pass-info" class="clearfix"></div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="mb-4">
      <button id="updt-prof-btn" type="submit" class="btn btn-primary">Update Profile</button>
    </div>
  </form>
  </div>

</div>
@endsection


@section('page-script')
{{-- <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script> --}}
<script src="{{asset('client_user/user/scripts/user-profile.js')}}"></script>
<script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('client_user/js/pw_strenght.js')}}"></script>
@endsection
