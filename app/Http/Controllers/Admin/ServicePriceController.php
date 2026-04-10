<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePrice;
use App\Services\Admin\AdminServicePriceManagementService;
use Illuminate\Http\Request;

class ServicePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(private readonly AdminServicePriceManagementService $adminServicePriceManagementService)
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Home"], ['name' => "Service Prices"]];
        return view('/pages/service-prices', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ServicePrice $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function show(ServicePrice $servicePrice)
    {
        return $this->adminServicePriceManagementService->getPriceRows();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ServicePrice $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicePrice $servicePrice, $id)
    {
        return $this->adminServicePriceManagementService->getPriceDetail((string) $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ServicePrice $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicePrice $servicePrice)
    {
        $this->adminServicePriceManagementService->updateByAction(
            (string) $request->action,
            (string) $request->id,
            $request->all()
        );
    }
}
