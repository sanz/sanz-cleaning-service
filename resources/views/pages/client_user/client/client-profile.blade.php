@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Profile')

@section('page-style')
	<link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
	<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/imageupload.css')}}" rel="stylesheet">
@endsection

@section('content')
  	<div class="box_general padding_bottom">
    	<div class="header_box version_2">
			<h2><i class="fa fa-user"></i>Profile details</h2>
		</div>
    	<div class="row">
      		<div class="col-md-4 mt-40">
				<form action="POST" id="clientImgForm" enctype="multipart/form-data">
					@csrf
					<div class="img-box">        
						<div id="profile">
							<div class="dashes"></div>
							<label>Click to browse or drag an image here</label>
						</div>
						<div class="editable">
							<h1 class="font-weight-bold">@isset($clientData['client_id']) #{{$clientData['client_id']}} @endisset</h1>
							{{-- <h1 contenteditable>@isset($clientData['first_name']) {{$clientData['first_name']}} {{$clientData['last_name']}} @endisset</h1><i class="fa fa-pencil"></i> --}}
						</div>
						<div class="stat">
							<div class="label">Reviews</div>
							<div class="num">40</div>
						</div>
						<div class="stat">
							<div class="label">Services</div>
							<div class="num">@isset($clientData['services']) {{$clientData['services']}} @endisset</div>
						</div>
					</div>
					<input type="file" name="client_img" id="mediaFile" />
				</form>

			</div>
      		<div class="col-md-8 add_top_30">

				@if ($clientData['status'] == "Blocked" )
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<div class="font-large-17 font-weight-bold">Stopped :)</div> 
						Your service is currently stopped by <b>the Sanz Team</b>.
					</div>
				
				@elseif ($clientData['status'] == "Rejected" )
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<div class="font-large-17 font-weight-bold">Rejected :)</div> 
						your application has been rejected by  <b>the Sanz Team</b>.
					</div>
				@endif
				  
        		<form id="updateClientDetail" method="POST" action="{{ route('clients.profile.update', 'detail')}}">
					@csrf
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label class="required">*</label><label>Full Name</label>
								<input type="text" class="form-control"	 name="client_name" @isset($clientData['name']) value="{{$clientData['name']}}" @endisset placeholder="Full Name" >
							</div>
						</div>
						<div class="col-md-4">
							<span class="text-dark font-large-2">
								<label>Status: </label>
							</span>
							<span class="mt-5 ml-2">
								@if ($clientData['status'] == "Blocked" )
									<i class="cancel">Blocked</i>
								@else
									<i class="approved">Active</i>
								@endif
							</span>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class=" form-group">
								<span class="mr-3">
									<label class="required">*</label><label for="gender">Gender:</label>
								</span>
								<span class="mr-2">
									<input type="radio" name="gender" value="male" @if ($clientData['client_gender'] == "male") checked @endif >
									<label> Male</label>
								</span>
								<span class="mr-2">
									<input type="radio" name="gender" value="female" @if ($clientData['client_gender'] == "female") checked @endif >
									<label> Female</label>
								</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="required">*</label><label>Mobile No.</label> 
								<input type="text" class="form-control numberValidation" name="client_mo" @isset($clientData['client_phone']) value="{{$clientData['client_phone']}}" @endisset placeholder="Your Mobile No.">
							</div>							
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="required">*</label><label>Email</label> 
								<input type="email" class="form-control" id="cl_email"  name="client_email" @isset($clientData['client_email']) value="{{$clientData['client_email']}}" @endisset placeholder="Your email">
							</div>
						</div>
					</div>

					<input type="text" name="client_img" @isset($clientData['client_img'])  value="{{$clientData['client_img']}}" @endisset id="profile_img" hidden>

					<div class="row">
						<div class="col">
							<button type="submit" id="client_sbt_btn" class="btn btn-success medium">Save</button>
							<a href="{{route('clients.dashboard')}}" class="btn btn-secondary medium ml-2">cancel</a>
						</div>
					</div>

        		</form>
      		</div>

			<div class="col-12 mt-3 form-group">
				<span class="font-medium-5">If you want to change password!</span>
				<a class="mt-5 text-primary font-weight-bolder" data-toggle="modal" href="#changePasswdModel">change password ?</a>
			</div>
		</div>
	</div>

	{{-- START: Changeing Password Modal --}}
  	<div class="modal fade" id="changePasswdModel" tabindex="-1" role="dialog" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title text-header"><i class="fa fa-lock"></i> Change Password</div>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="container-fluid">
						<form id="changePasswordForm" method="POST" action="{{route('clients.profile.update','password')}}" autocomplete="off">
							@csrf
							<section class="old_password">
								<div class="form-group input-container mb-0">
									<i class="fa fa-lock"></i>
									<label class="required">*</label><label>Old password</label>
									<input class="form-control" id="oldPassword" type="password" name="old_password" placeholder="Old Password">
									<label id="oldPassword-error" class="error" for="oldPassword"></label>
								</div>
							</section>
							
							<section class="new_password" hidden>
								<div class="form-group">
									<i class="fa fa-lock"></i>
									<label class="required">*</label><label>New password</label>

									<input class="form-control" type="password" name="new_password" placeholder="New Password" id="newPassword">
									<span toggle="#newPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>

								<div class="form-group">
									<i class="fa fa-lock"></i>
									<label class="required">*</label><label>Confirm Password</label>
									<input class="form-control" id="conPassword" type="password" name="con_password" placeholder="Confirm Password">
								</div>

							</section>

							<div id="pass-info" class="clearfix"></div>
							<div class="text-right">
								<button type="button" class="btn btn-info" id="btn_confirm">Confirm</button>
								<button type="submit" class="btn btn-primary" id="sbt_btn" hidden>Save</button>
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              				</div>
            			</form>
          			</div>
				</div>
      		</div>
    	</div>
  	</div>
	{{-- END: Changeing Password Modal --}}

@endsection

@section('page-script')
	<script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('client_user/js/pw_strenght.js') }}"></script>
	<script src="{{ asset('client_user/client/js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('client_user/client/js/page-scripts/client-profile.js')}}"></script>
@endsection


@section('custom-script')
	<script src="{{asset('client_user/client/js/dropzone.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/imageupload.js')}}"></script>
@endsection
