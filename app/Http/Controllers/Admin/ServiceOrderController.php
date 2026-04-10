<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\AdminServiceOrderManagementService;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function __construct(private readonly AdminServiceOrderManagementService $adminServiceOrderManagementService)
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Home"], ['name' => "Booking Schedule"]];
        return view('/pages/booking-schedule', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $orderManage
     * @return \Illuminate\Http\Response
     */
    public function show(Order $orderManage, Request $request)
    {
        return $this->adminServiceOrderManagementService->getOrderRows(
            (string) $request->action,
            $request->action === 'search' ? (string) $request->text : null
        );
    }
}
