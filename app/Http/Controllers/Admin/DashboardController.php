<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private readonly AdminDashboardService $adminDashboardService)
    {
        $this->middleware("auth");
    }

    // Dashboard - Analytics
    public function dashboardAnalytics()
    {
        $analytics = $this->adminDashboardService->getAnalytics();

        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard-analytics', [
            'pageConfigs' => $pageConfigs,
            'countClient' => $analytics['countClient'],
            'countReview' => $analytics['countReview'],
            'countOrder' => $analytics['countOrder'],
            'countUser' => $analytics['countUser']

        ]);
    }

    public function orderDetails(Request $request)
    {
        return json_encode($this->adminDashboardService->getOrderDetails());
    }
}
