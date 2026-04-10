/*=========================================================================================
	File Name: dashboard-analytics.js
	Description: dashboard analytics page content with Apexchart Examples
	----------------------------------------------------------------------------------------
	Item name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
	Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {

	var $primary = '#7367F0';
	var $warning = '#FF9F43';
	var $primary_light = '#8F80F9';
	var $warning_light = '#FFC085';

	// Product Order Chart starts
	// -----------------------------
	{
		HoldOn.open(options);
		var url = "/admin/dashboard/order-details";
		var data = {
			"_token": $("meta[name='csrf-token']").attr("content"),
		};
		$.post(url, data, function (result) {
			result = JSON.parse(result);
			
			var productChartoptions = {
				chart: {
					height: 325,
					type: 'radialBar',
				},
				colors: [$primary, $warning],
				fill: {
					type: 'gradient',
					gradient: {
						// enabled: true,
						shade: 'dark',
						type: 'vertical',
						shadeIntensity: 0.5,
						gradientToColors: [$primary_light, $warning_light],
						inverseColors: false,
						opacityFrom: 1,
						opacityTo: 1,
						stops: [0, 100]
					},
				},
				stroke: {
					lineCap: 'round'
				},
				plotOptions: {
					radialBar: {
						size: 165,
						hollow: {
							size: '20%'
						},
						track: {
							strokeWidth: '100%',
							margin: 15,
						},
						dataLabels: {
							name: {
								fontSize: '18px',
							},
							value: {
								fontSize: '16px',
							},
							total: {
								show: true,
								label: 'Total',

								formatter: function (w) {
									return result[0];
								}
							}
						}
					}
				},
				series: [result[3], result[4]],
				labels: ['Finished', 'Pending'],

			}

			var productChart = new ApexCharts(
				document.querySelector("#product-order-chart"),
				productChartoptions
			);
			productChart.render();
	
			$('.od_finish').text(result[1]);
			$('.od_pending').text(result[2]);
		})
			.always(function () {
				HoldOn.close();
			});
	}
	// Product Order Chart ends //
});
