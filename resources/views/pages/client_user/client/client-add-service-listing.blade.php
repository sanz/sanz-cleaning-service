@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Add Service Listing')

@section('page-style')
	<link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/fullcalendar.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/fullcalendar.print.css')}}" rel="stylesheet" media="print">
@endsection

@section('custom-style')
	<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('client_user/client/css/summernote-bs4.css')}}" rel="stylesheet">
@endsection

@section('content')
	<form method="POST" action="{{ route('clients.services.store') }}" id="addServiceListForm" enctype="multipart/form-data">
		@csrf
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Service info</h2>
			</div>
			<input type="text" value="1" id="user_id" name="user_id" hidden>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label for="ser_name">Service Name </label>
						<select id="ser_name" name="ser_name" class="form-control styled-select">
							@if (empty($serviceList))
								<option value="-1" disabled selected>No Data Found</option>
							@else
								<option value="-1" disabled selected>Select Service</option>
								{{-- Print Service Name --}}
								@foreach ($serviceList as $row)
									<option value="{{$row['ser_name']}}" data-category="{{$row['ser_cat']}}" data-id="{{$row['main_id']}}" @isset($serviceData) @if($serviceData['service_name']  == $row['ser_name']) selected @endif @endisset >{{$row['ser_name']}}</option>
								@endforeach
							@endif

						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label for="ser_category">Category</label>
						<input type="text" class="form-control" name="ser_category" value="@isset($serviceData){{$serviceData['service_cat']}}@endisset" id="ser_category" placeholder="Category" disabled>
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">

				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Shop Name / Provider Name</label>
						<input type="text" class="form-control" name="provider_name" value="@isset($serviceData){{$serviceData['name']}}@endisset" placeholder="Shop Name / Provide Name">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Expericence in related Field (In Months/Years)</label>
						<input type="text" class="form-control" name="ser_exp" value="@isset($serviceData){{$serviceData['exp']}}@endisset" placeholder="2 Months / 2 Years">
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-12">
					@if(isset($serviceData))
						<input type="text" id="ser_des" value="{{$serviceData['dec']}}" hidden>
					@endif
					<div class="form-group">
						<label for="SL_ser_description">Description</label>
						<div class="editor" id="summernote"></div>
					</div>
				</div>
			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-phone"></i> Phone (Optional)</label>
						<input type="text" class="form-control" name="ser_phone" id="ser_phone" value="@isset($serviceData){{$serviceData['phone']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-link"></i> Web site (Optional)</label>
						<input type="text" class="form-control" name="ser_website" value="@isset($serviceData){{$serviceData['web']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-envelope"></i> Email (Optional)</label>
						<input type="text" class="form-control" name="ser_email"  value="@isset($serviceData){{$serviceData['email']}}@endisset">
					</div>
				</div>

			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-facebook"></i> Facebook link (Optional)</label>
						<input type="text" class="form-control" name="ser_fblink" value="@isset($serviceData){{$serviceData['fb']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-twitter"></i> Twitter link (Optional)</label>
						<input type="text" class="form-control" name="ser_twlink" value="@isset($serviceData){{$serviceData['tw']}}@endisset">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label><i class="fa fa-fw fa-instagram"></i> Instagram link (Optional)</label>
						<input type="text" class="form-control" name="ser_ldlink" value="@isset($serviceData){{$serviceData['linkedin']}}@endisset">
					</div>
				</div>

			</div>
			<!-- /row-->

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Photos</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="ser_img">
							<label class="custom-file-label">Choose file</label>
							@if(@isset($serviceData))
								<input type="text" name="ser_img_file" value="{{$serviceData['img']}}" hidden>
							@endif
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
		</div>

		<!-- /box_general-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-id-card"></i>Document</h2>
			</div>

			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label class="required">*</label><label for="SL_ser_idproof">Upload Id Proof</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="ser_doc_img">
							<label class="custom-file-label">Choose file</label>
							@if(isset($serviceData))
								<input type="text" name="ser_doc_file" value="{{$serviceData['doc_img']}}" id="ser_doc_file" hidden>
							@endif
							<label class="small font-weight-bold text-secondary">You can upload Aadhar Card/ Pan card/ Driving Licence as Id Proof.</label>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Aadhar No.</label>
						<input type="text" class="form-control num_valid" name="ser_doc_no" value="@isset($serviceData){{$serviceData['doc_num']}}@endisset" placeholder="Aadhar No.">
					</div>
				</div>

			</div>
		</div>
		<!-- /box_general-->

		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-map-marker"></i>Location</h2>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>State</label>

						<select class="form-control styled-select" name="ser_state" id="ser_state" @if (!isset($state)) readonly @endif>
							@if (isset($state))
								<option value="-1" selected disabled>Select State</option>
								@foreach($state as $row)
									<option value="{{$row['main_id']}}" @if($serviceData['state'] == $row['state']) selected @endif >{{$row['state']}}</option>
								@endforeach
							@else
								<option value="-1" selected disabled>Not Found !!</option>
							@endif
						</select>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Select City</label>
						<select name="ser_city" id="ser_city" class="form-control styled-select" @if (!isset($city)) readonly @endif>
							@if (isset($city))
								<option value="-1" selected disabled>Select City</option>
								@foreach($city as $row)
									<option value="{{$row['main_id']}}" @if($serviceData['city'] == $row['city']) selected @endif >{{$row['city']}}</option>
								@endforeach
							@else
								<option value="-1" selected disabled>Not Found !!</option>
							@endif
						</select>
					</div>
				</div>
			</div>

			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label>Address</label>
						<input type="text" class="form-control" placeholder="ex. 250, Fifth Avenue..." name="ser_address" id="ser_address" @if (isset($serviceData)) value="{{$serviceData['address']}}" @else readonly @endif>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="required">*</label><label for="ser_pin_no">Pin Code</label>
						<input type="text" class="form-control" name="ser_pin_no" id="ser_pin_no" placeholder="ex. 112233" @if (isset($serviceData)) value="{{$serviceData['pin_code']}}" @else readonly @endif>
					</div>
				</div>
			</div>
			<!-- /row-->
		</div>

		<!-- /box_general-->
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-clock-o"></i>Availability</h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class=" form-group">
						<div class="mr-3 ">
							<label class="required">*</label><label for="days" class="mr-3">Working days in Week:</label>
						</div>
						<div class="row">
							<span class="mr-2 col-md-1 col-sm-12">
								<input type="radio" name="days" value="ALL" required>
								<label> All</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="6D" checked>
								<label> 6 Days (Mon-Sat)</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="5D">
								<label> 5 Days (Mon-Fri)</label>
							</span>
							<span class="mr-2 col-md-2 col-sm-12">
								<input type="radio" name="days" value="CUSTOM">
								<label> Custom</label>
							</span>
						</div>
						@if(@isset($serviceData))
							<input type="text" id="days" value="{{$serviceData['days']}}" hidden>
							<input type="text" id="days_time" value="{{$serviceData['days_time']}}" hidden>
						@endif
					</div>
				</div>

				<div id="def_days" class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<label class="fix_spacing" id="days_name">Mon - Sat</label>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value optime" name="opening_time" id="start_time"></select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value cltime" name="closing_time" id="end_time"></select>
							</div>
						</div>
					</div>
				</div>

				<div id="add-day-div" class="col-md-12" hidden="hidden">
					<div class="row add-day-data">
						<div class="col-md-2">
							<label class="fix_spacing">Monday</label>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value start_time" name="opening_time"></select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<select class="form-control styled-select styled-select-value end_time" name="closing_time"></select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /box_general-->

		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-dollar"></i>Pricing</h2>
			</div>

			<div class="row">
				<div class="col-md-12">
					<label class="required">*</label><span>Item</span> 
					<table id="pricing-list-container" class="w-100 mt-10">
						@isset($serviceData)
							@foreach (($serviceData['item'] ?? []) as $item )
								<tr class="pricing-list-item">
									<td>
										<input type="text" name="item_id" value="{{ $item['iID'] ?? $item['item_id'] ?? '' }}" hidden>
										<div class="row ">
											<div class="col-md-3">
												<div class="form-group">
													<input type="text" class="form-control" value="{{ $item['iName'] ?? $item['name'] ?? '' }}" placeholder="Title" name="pli_name">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<input type="text" class="form-control" value="{{ $item['iDes'] ?? $item['description'] ?? '' }}"  placeholder="Description" name="pli_desc">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="price_icon"><small>$CA</small></span>
													</div>
													<input type="text" id="item_price" name="pli_price" class="form-control" value="{{ $item['iPrice'] ?? $item['item_price'] ?? '' }}"  placeholder="Price" aria-describedby="price_icon">
												</div>
											</div>
											<div class="col-md-1 ">
												<div class="form-group pt-2">
													<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@endisset
						<tr class="pricing-list-item">
							<td>
								<div class="row ">
									<div class="col-md-3">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Title" name="pli_name">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Description" name="pli_desc">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="price_icon"><small>$CA</small></span>
											</div>
											<input type="text" id="item_price" name="pli_price" class="form-control" placeholder="Price" aria-describedby="price_icon">
										</div>
									</div>
									<div class="col-md-1 ">
										<div class="form-group pt-2">
											<a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<button type="button" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle mr-1"></i>Add Item</button>
				</div>
			</div>
			<!-- /row-->
		</div>
		<!-- /box_general-->
		<p>
			<input type="submit" class="btn_1 medium" id="sbt_btn" value="Save" data-action="@if (@isset($serviceData)) update @else insert @endif" data-id="@if (@isset($serviceData)) {{$serviceData['main_id']}} @endif">
		</p>
	</form>


	<div class="card">
		<div id="cus_id" class="header"> </div>
	</div>

@endsection

@section('page-script')
	<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('custom-script')
	<script src="{{asset('client_user/client/js/dropzone.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/summernote-bs4.min.js')}}"></script>
	<script>
      $('.editor').summernote({
          fontSizes: ['10', '14', '16', '18'],
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough']],
              ['fontsize', ['fontsize']],
              ['para', ['ul', 'ol', 'paragraph']]
          ],
          placeholder: 'Write here ....',
          tabsize: 2,
          height: 200
      });
	</script>

	<!-- SPECIFIC CALENDAR -->
	<script src="{{asset('client_user/client/js/moment.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/jquery-ui.custom.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/fullcalendar.min.js')}}"></script>
	<script src="{{asset('client_user/client/js/fullcalendar_func.js')}}"></script>
	<script src="{{asset('client_user/client/js/page-scripts/client-add-service-listing.js')}}"></script>
	<script src="{{asset('client_user/client/js/sweetalert2.min.js')}}"></script>
@endsection
