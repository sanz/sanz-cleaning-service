
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Sanz!</title>
	<meta charset="utf-8" />
	<style type="text/css">/* CLIENT-SPECIFIC STYLES */
	body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
	table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
	img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

	/* RESET STYLES */
	img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
	table{border-collapse: collapse !important;}
	body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

	/* iOS BLUE LINKS */
	a[x-apple-data-detectors] {
		color: inherit !important;
		text-decoration: none !important;
		font-size: inherit !important;
		font-family: inherit !important;
		font-weight: inherit !important;
		line-height: inherit !important;
	}

	/* MOBILE STYLES */
	@media screen and (max-width: 525px) {

	/* ALLOWS FOR FLUID TABLES */
	.wrapper {
		width: 100% !important;
		max-width: 100% !important;
	}

	/* ADJUSTS LAYOUT OF LOGO IMAGE */
	.logo img {
		margin: 0 auto !important;
	}

	/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
	.mobile-hide {
		display: none !important;
	}

	.img-max {
		max-width: 100% !important;
		width: 100% !important;
		height: auto !important;
	}

	.img-minmax {
		max-width: 100% !important;
		height: auto !important;
	}

	/* FULL-WIDTH TABLES */
	.responsive-table {
		width: 100% !important;
	}

	/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
	.logo {
		padding: 0 5% 30px 5% !important;
	}

	.padding {
		padding: 10px 5% 15px 5% !important;
	}

	.padding-top {
		padding: 0 5% 15px 5% !important;
	}

	.padding-bottom {
		padding: 10px 5% 0 5% !important;
	}

	.padding-right {
		padding: 10px 8% 0 0 !important;
	}

	.padding-column {
		padding: 0 5% 0 5% !important;
	}

	.padding-meta {
		padding: 30px 5% 0px 5% !important;
		text-align: center;
	}

	.no-padding {
		padding: 0 !important;
	}

	.section-padding {
		padding: 50px 15px 50px 15px !important;
	}

	.section-padding-top {
		padding: 0 15px 50px 15px !important;
	}

	.section-padding-bottom {
		padding: 50px 15px 0 15px !important;
	}

	.section-padding-logo {
		padding: 30px 15px 50px 15px !important;
	}

	/* ADJUST BUTTONS ON MOBILE */
	.mobile-button-container {
		margin: 0 auto;
		width: 70% !important;
	}

	.mobile-button {
		padding: 15px !important;
		border: 0 !important;
		font-size: 16px !important;
		display: block !important;
		width: 70% !important;
	}

	.mobile-button-outline {
		padding: 15px !important;
		border: 1px solid #ffffff !important;
		font-size: 16px !important;
		display: block !important;
	}

	}

	/* ANDROID CENTER FIX */
	div[style*="margin: 16px 0;"] {
		margin: 0 !important;
	}
	</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<table border="0" cellpadding="0" cellspacing="0" height="1" width="1">

</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%"><!-- VIEW IN BROWSER -->

		<tr>
			<td align="center" bgcolor="#333333"><!--[if (gte mso 9)|(IE)]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
			<tr>
			<td align="center" valign="top" width="500">
			<![endif]-->
			<table border="0" cellpadding="0" cellspacing="0" class="wrapper" style="max-width: 500px;" width="100%">

			</table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]--></td>
		</tr>
		<!-- /VIEW IN BROWSER --><!-- /SECTION - LOGO, ONE COLUMN (IMAGE TOP) -->
		<tr>
			<td align="center" bgcolor="#ffffff" class="section-padding-logo" style="padding: 50px 15px 50px 15px;"><!--[if (gte mso 9)|(IE)]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
			<tr>
			<td align="center" valign="top" width="500">
			<![endif]-->
			<table border="0" cellpadding="0" cellspacing="0" class="responsive-table" style="max-width: 500px;" width="100%">

					<tr>
						<td align="center" class="logo" valign="top"><a href="{{route('home')}}" name="sanz" target="_blank" ><img alt="sanz" border="0"  height="45"   src="{{asset('client_user/img/logo.png')}}" style="display: block; font-family: 'proxima_nova_bold', Proxima Nova, Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" title="sanz" width="150"  /> </a></td>
					</tr>

			</table>

			<table border="0" cellpadding="0" cellspacing="0" class="responsive-table" style="max-width: 500px;" width="100%">

					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%"><!-- Image Top-->


								<!-- /Image Top --><!-- Copy -->
								<tr>
									<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%"><!-- Copy Title -->

											<tr>
												<td align="center" class="padding" style="font-size: 30px; font-weight: bold; font-family: 'proxima_nova_bold', Proxima Nova, Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;">Welcome to Sanz, {{$clnt['name']}}</td>
											</tr>
											<!-- /Copy Title --><!-- Copy Body -->
											<tr>
												<td align="center" class="padding" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">You are one step ahead to provide your service on sanz. we believe you are our valuable client and we provide all our support to you to list your First service on Sanz. Happy to see you onboarding <br> Here are some steps to list your Service</td>
											</tr>
											<!-- /Copy Body -->

									</table>
									</td>
								</tr>
								<!-- /Copy -->

						</table>

						<table border="0" cellpadding="0" cellspacing="0" width="100%">
						</table>

						<table border="0" cellpadding="0" cellspacing="0" width="100%">
						</table>
						</td>
					</tr>

			</table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]--></td>
		</tr>
		<!-- /SECTION - LOGO, ONE COLUMN (IMAGE TOP) --><!-- SECTION - TWO COLUMN (SIDE IMAGE) -->
		<tr>
			<td align="center" bgcolor="#F6F6F6" class="section-padding" style="padding: 60px 15px 60px 15px;"><!--[if (gte mso 9)|(IE)]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
			<tr>
			<td align="center" valign="top" width="500">
			<![endif]-->
			<table border="0" cellpadding="0" cellspacing="0" class="responsive-table" style="max-width: 500px;" width="100%"><!-- Copy Title -->

					<tr>
						<td align="center" class="padding" style="font-size: 30px; font-weight: bold; font-family: 'proxima_nova_bold', Proxima Nova, Helvetica, Arial, sans-serif; color: #333333; padding:0 0 0x 0;">How to Get Started</td>
					</tr>
					<!-- /Copy Title --><!-- Copy Body -->
					<tr>
						<td align="center" class="padding" style="padding: 20px 0 40px 0; font-size: 16px; line-height: 25px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">We are looking forward to provide your Valuable Service to our Customers! Here are a few helpful Steps so you can get started using Sanz.</td>
					</tr>
					<!-- /Copy Body --><!--- ROW 1 --->
					<tr>
						<td style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top" valign="top">
						<table style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;border-spacing:0;line-height:150%;width:100%">

								<tr class="padding" style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif"><!--- ICON --->
									<td class="padding-right" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top;text-align:center;width:60px;padding-top:5px;padding-left:20px;padding-right:40px" valign="top"><img border="0"  height="150"   src="{{ asset('client_user/img/email/ico-download-app3.png') }}" style="margin:0; padding:0; max-height:90px; max-width:90px;margin:0;" width="150"  /></td>
									<!--- /ICON ---><!--- CONTENT --->
									<td class="padding-right" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top">
									<div class="h2" style="margin:0; padding:0; color: #333333; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; font-weight: normal; text-rendering:optimizelegibility; font-size:24px; line-height:28px; padding-bottom:10px">Step 1: Login to your Client Account</div>

									<div class="p " style="padding: 0 0 0 0; font-size: 16px; line-height: 25px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">Log in to Sanz Client Account. If you already loged-in then Go ahead to the next step</div>
									<!--- /CONTENT ---><!--- CTA BUTTON ---><a class="mobile-button" href="{{route('auth.login')}}" name="Download_App" style="font-size: 14px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 8px 20px; margin:15px 0 0 0; border: 1px solid #f7971c; background-color:#f7971c; display: inline-block; text-align:center;" target="_blank" >Login Now</a> <!--- /CTA BUTTON ---></td>
								</tr>

						</table>
						<!--- /ROW 1 ---><!--- SPACING --->

						<table cellpadding="0" cellspacing="0" class="spacer" style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;border-spacing:0;line-height:150%;width:100%;font-size: 0; line-height: 0;" width="100%">

								<tr style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif">
									<td height="40" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top;font-size: 0;">&nbsp;</td>
								</tr>

						</table>
						<!--- /SPACING ---><!--- ROW 2 --->

						<table style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;border-spacing:0;line-height:150%;width:100%"><!--- ICON --->

								<tr style="margin:0;padding:0;">
									<td class="padding-right" style="margin:0;padding:0;vertical-align:top;text-align:center;width:60px;padding-top:5px;padding-left:20px;padding-right:40px" valign="top"><img border="0"  height="150"   src='{{asset('client_user/img/email/ico-itinerary2.png')}}' style="margin:0; padding:0; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; max-height:90px; max-width:90px;margin:0;" width="150"  /></td>
									<!--- /ICON ---><!--- CONTENT --->
									<td class="padding-right" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top">
									<div class="h2" style="margin:0; padding:0; color: #333333; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; font-weight: normal; text-rendering:optimizelegibility; font-size:24px; line-height:28px; padding-bottom:10px">Step 2: Fill Service Listing Form</div>

									<div class="p " style="padding: 0 0 0 0; font-size: 16px; line-height: 25px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">After Successfull login you can add your services on sanz by Adding your service related info on service listing Page.</div>
									<!--- /CONTENT ---><!--- CTA BUTTON ---><a class="mobile-button" href="{{route('clients.services.index')}}" name="Create_itinerary" style="font-size: 14px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 8px 20px; margin:15px 0 0 0; border: 1px solid #f7971c; background-color:#f7971c; display: inline-block; text-align:center;" target="_blank" >Add Service</a> <!--- /CTA BUTTON ---></td>
								</tr>

						</table>
						<!--- /ROW 2 ---><!--- SPACING --->

						<table cellpadding="0" cellspacing="0" class="spacer" style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;border-spacing:0;line-height:150%;width:100%;font-size: 0; line-height: 0;" width="100%">

								<tr style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif">
									<td height="40" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top;font-size: 0;">&nbsp;</td>
								</tr>

						</table>
						<!--- /SPACING ---><!--- ROW 3 --->

						<table style="margin:0;padding:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;border-spacing:0;line-height:150%;width:100%"><!--- ICON --->

								<tr style="margin:0;padding:0;">
									<td class="padding-right" style="margin:0;padding:0;vertical-align:top;text-align:center;width:60px;padding-left:20px;padding-right:40px" valign="top"><img border="0"  height="150"   src='{{asset('client_user/img/email/ico-profile2.png')}}' style="margin:0; padding:0; max-height:90px; max-width:90px;margin:0;" width="150"  /></td>
									<!--- /ICON ---><!--- CONTENT --->
									<td class="padding-right" style="margin:0;font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif;padding:0;vertical-align:top">
									<div class="h2" style="margin:0; padding:0; color: #333333; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; font-weight: normal; text-rendering:optimizelegibility; font-size:24px; line-height:28px; padding-bottom:10px">Step 3: View Your Order</div>

									<div class="p " style="padding: 0 0 0 0; font-size: 16px; line-height: 25px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">your service listed on sanz and you can view and manage your orders from your order panel dashboard</div>
									<!--- /CONTENT ---><!--- CTA BUTTON ---><a class="mobile-button" href="{{route('clients.orders.index')}}" name="Complete_profile" style="font-size: 14px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 8px 20px; margin:15px 0 0 0; border: 1px solid #f7971c; background-color:#f7971c; display: inline-block; text-align:center;" target="_blank" >View Orders</a> <!--- /CTA BUTTON ---></td>
								</tr>

						</table>
						<!--- /ROW 3 ---></td>
					</tr>

			</table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]--></td>
		</tr>
		<!-- SECTION - FOOTER -->
		<tr>
			<td align="center" bgcolor="#444444" class="section-padding" style="padding: 50px 15px 50px 15px;"><!--[if (gte mso 9)|(IE)]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
			<tr>
			<td align="center" valign="top" width="500">
			<![endif]-->
			<table border="0" cellpadding="0" cellspacing="0" class="responsive-table" style="max-width: 500px;" width="100%">

					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%"><!-- Image Middle-->


								<!-- /Image Middle --><!-- Copy -->
								<tr>
									<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%"><!-- Copy Body -->


											<!-- /Copy Body --><!-- Copy Body -->
											<tr>
												<td align="center" class="padding" style="padding: 15px 0 0 0; font-size: 10px; line-height: 15px; font-family: 'proxima_nova_reg', Proxima Nova, Helvetica, Arial, sans-serif; color: #999999;">You are receiving this email because you are opted into Sanz New updates.<br />
												&copy; {{date("Y")}}, Sanz Technologies, Inc. All rights reserved. Sanz&reg; is a registered trademark of Sanz Technologies, Inc. Other trademarks held by their respective owners.</td>
											</tr>
											<!-- /Copy Body --><!-- Copy Body -->

											<!-- /Copy Body -->

									</table>
									</td>
								</tr>
								<!-- /Copy -->

						</table>
						</td>
					</tr>

			</table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]--></td>
		</tr>
		<!-- /SECTION - FOOTER -->
</body>
</html>
