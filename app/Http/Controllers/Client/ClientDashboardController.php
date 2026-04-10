<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientDashboardService;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(private readonly ClientDashboardService $clientDashboardService)
    {
        $this->middleware("auth:client");
    }

    public function index()
    {
        $id = Auth::guard('client')->user()->id;
        $counts = $this->clientDashboardService->getDashboardCounts((int) $id);

        $breadcrumbs = [['link' => "/clients/dashboard", 'name' => "Dashboard"],['name' => "My Dashboard"]];

        return view('/pages/client_user/client/client-dashboard', [
            'breadcrumbs' => $breadcrumbs,
            'countService' => $counts['countService'],
            'countOrder' => $counts['countOrder'],
            'countReview' => $counts['countReview'],
        ]);

//      return view('/pages/client_user/client/client-dashboard');
    }
}
