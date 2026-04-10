<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderBookedJob;
use App\Models\Order;
use App\Services\Client\ClientOrderManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ClientOrderController extends Controller
{
    public function __construct(private readonly ClientOrderManagementService $clientOrderManagementService)
    {
        $this->middleware('auth:client')->except(['store', 'create']);
    }

    public function index()
    {
        $orderList = $this->clientOrderManagementService->getOrderList((int) Auth::id());
        $breadcrumbs = [['link' => '/clients/dashboard', 'name' => 'Dashboard'], ['name' => 'Manage Orders']];

        return view('/pages/client_user/client/client-order-manage', [
            'breadcrumbs' => $breadcrumbs,
            'orderList' => $orderList,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'pincode' => 'required|digits:6|integer',
        ]);

        $customer = Auth::guard('customer')->user();
        $result = $this->clientOrderManagementService->createOrder(
            (int) $request->id,
            (int) $customer->id,
            $request->all(),
            [
                'date' => $request->cookie('date'),
                'selected_time' => $request->cookie('selected_time'),
                'services' => $request->cookie('services'),
            ]
        );

        $mailData = $result['mail_data'];
        $mailData['email'] = $customer->user_email;
        $mailData['name'] = $customer->user_name;

        dispatch(new SendOrderBookedJob($mailData));

        Cookie::queue(Cookie::forget('date'));
        Cookie::queue(Cookie::forget('selected_time'));
        Cookie::queue(Cookie::forget('services'));

        return redirect(route('customers.orders.confirm.success', ['id' => $result['order']->order_code]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'selected_time' => 'required',
            'services' => 'required',
        ]);

        $cookie1 = cookie('date', $request->date);
        $cookie2 = cookie('selected_time', $request->selected_time);
        $cookie3 = cookie('services', json_encode($request->services));

        return redirect(route('customers.orders.confirm.show', ['id' => $request->id]))
            ->cookie($cookie1)
            ->cookie($cookie2)
            ->cookie($cookie3);
    }

    public function show(Order $orderManage, Request $request)
    {
        $id = $request->get('id');
        $action = $request->get('action');

        switch ($action) {
            case 'Detail':
                return $this->clientOrderManagementService->getOrderDetail((int) $id);
        }

        return [];
    }
}
