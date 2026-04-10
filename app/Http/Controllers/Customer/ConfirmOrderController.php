<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerConfirmOrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmOrderController extends Controller
{
    public function __construct(private readonly CustomerConfirmOrderService $confirmOrderService)
    {
        $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
        $serviceId = (int) $request->id;
        if ($serviceId <= 0) {
            return view('/pages/error-404');
        }

        $data = $this->confirmOrderService->getConfirmationData($serviceId, $request->cookie('services'));
        if (!$data['service']) {
            return view('/pages/error-404');
        }

        return view('/pages/client_user/user/user-confirm-order')
            ->with('service', $data['service'])
            ->with('items', $data['items']);
    }

    public function getInvoice(Request $request)
    {
        try {
            $customerId = (int) Auth::guard('customer')->id();
            $invoiceData = $this->confirmOrderService->getInvoiceData((string) $request->order_id, $customerId);
            if (!$invoiceData) {
                return redirect(route("customers.orders.index"));
            }

            return view("/pages/client_user/user/invoice", [
                "data" => $invoiceData
            ]);
        } catch (Exception $e) {
            return redirect(route("customers.orders.index"));
        }
    }
}
