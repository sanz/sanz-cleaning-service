<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerOrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(private readonly CustomerOrderService $customerOrderService)
    {
        $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
        $data = $this->customerOrderService->getOrders((int) Auth::guard('customer')->user()->id);

        $breadcrumbs = [['link' => route('home'), 'name' => "Dashboard"], ['name' => "My Order"]];
        return view('/pages/client_user/user/my-order', [
            'breadcrumbs' => $breadcrumbs,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orderId = (int) $request->id;
        if ($orderId <= 0) {
            return view('/pages/error-404');
        }

        $tmp = $this->customerOrderService->markOrderComplete($orderId);

        if ($tmp) {
            return true;
        } else {
            return false;
        }
    }
}
