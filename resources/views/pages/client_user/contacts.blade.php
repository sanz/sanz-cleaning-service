@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'pages.contact')

@section('specific-style')
<link href="{{asset('client_user/css/contacts.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header clearfix element_to_stick')

@section('content')
<main>
	<div class="hero_single inner_pages background-image"
		data-background="url({{asset('client_user/img/contact.jpg')}})">
		<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.1)">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-10 col-md-8">
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
	</div>
	<!-- /hero_single -->

	<div class="bg_gray">
		<div class="container margin_60_40">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div>
						<div class="box_contacts">
							<i class="icon_lifesaver"></i>
							<h2>Help Center</h2>
							<a href="mailto:digyata125@gmail.com">digyata125@gmail.com</a>
							<small>MON to SAT 9am-6pm</small>
						</div>
					</div>
					<div>
						<div class="box_contacts">
							<i class="icon_pin_alt"></i>
							<h2>Address</h2>
							<div>Mahesana</div>
							<small>MON to SAT 9am-6pm</small>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="row justify-content-center">
						<div class="col-md-8">
							@if (session()->has('msg'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Success!</strong> {{session('msg')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@endif
							<div class="box_general padding">
								<div class="text-center add_bottom_15">
									<h4 class="mb_5">Drop Us a Line</h4>
								</div>
								<div class="col-12">
									<form id="contactform" method="POST" action="{{route('pages.contact.store')}}"
										enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<input class="form-control @error('name') is-invalid @enderror" type="text"
												placeholder="*Name" id="name_contact" name="name">
											@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<input class="form-control @error('name') is-invalid @enderror" type="email"
												placeholder="*Email" id="email_contact" name="email">
											@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<textarea class="form-control @error('name') is-invalid @enderror"
												style="height: 150px;" placeholder="*Message" id="message_contact"
												name="message"></textarea>
											@error('message')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<button class="btn_1 full-width" type="submit"
												id="submit-contact">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /row -->
	</div>
	<!-- /container -->
	</div>
	<!-- /bg_gray -->
</main>
<!-- /main -->
@endsection