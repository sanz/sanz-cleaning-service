<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientReviewService;

class ClientReviewController extends Controller
{
    public function __construct(private readonly ClientReviewService $clientReviewService)
    {
        $this->middleware("auth:client");
    }

    public function index()
    {
        $reviews = $this->clientReviewService->getClientReviews((int) auth()->guard('client')->user()->id);
        $breadcrumbs = [['link' => "/clients/dashboard", 'name' => "Dashboard"], ['name' => "Reviews"]];
        return view('/pages/client_user/client/client-review', [
        'breadcrumbs' => $breadcrumbs
        ])->with('reviews', $reviews);
    }
}
