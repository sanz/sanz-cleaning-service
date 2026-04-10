<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Services\Admin\AdminClientManagementService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(private readonly AdminClientManagementService $adminClientManagementService)
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
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Home"], ['name' => "Clients"]];
        return view('/pages/client-manage', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, Request $request)
    {

        if ($request->action == "Pending") {
            return $this->adminClientManagementService->getPendingCount();
        } else {
            return $this->adminClientManagementService->getClientRows();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        switch ($request->action) {
            case 'status':
                $this->adminClientManagementService->updateClientStatus(
                    (string) $request->id,
                    (string) $request->status
                );
                break;
        }
    }

    public function showClientData(Request $request)
    {
        return $this->adminClientManagementService->getClientServices((string) $request->get('id'));
    }
}
