<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerClientDetailService;
use Illuminate\Http\Request;

class ClientDetailController extends Controller
{
    public function __construct(private readonly CustomerClientDetailService $clientDetailService)
    {
    }

    public function index(Request $request)
    {
        $serviceId = (int) $request->id;
        if ($serviceId <= 0) {
            return view('/pages/error-404');
        }

        $customerId = auth()->guard('customer')->check()
            ? (int) auth()->guard('customer')->user()->id
            : null;

        $data = $this->clientDetailService->getDetailData($serviceId, $customerId);
        if (empty($data)) {
            return view('/pages/error-404');
        }

        return view('/pages/client_user/user/client-detail')
            ->with('service', $data['service'])
            ->with('items', $data['items'])
            ->with('reviews', $data['reviews'])
            ->with('avg', $data['avg'])
            ->with('usrReview', $data['usrReview']);
    }
}
