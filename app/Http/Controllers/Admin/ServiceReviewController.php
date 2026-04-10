<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceReview;
use App\Services\Admin\AdminServiceReviewManagementService;
use Illuminate\Http\Request;

class ServiceReviewController extends Controller
{
    public function __construct(
        private readonly AdminServiceReviewManagementService $adminServiceReviewManagementService
    ) {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Home"], ['name' => "Service Reviews"]];
        return view('/pages/review-order', [
        'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceReview  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceReview $reviewOrders, Request $request)
    {
        return $this->adminServiceReviewManagementService->getReviewRows();
    }
}
