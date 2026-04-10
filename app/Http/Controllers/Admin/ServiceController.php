<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminServiceManagementService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private readonly AdminServiceManagementService $adminServiceManagementService)
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
        $breadcrumbs = [['link' => route('dashboard'), 'name' => "Home"], ['name' => "Services"]];
        return view('/pages/services', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Return services rows for the admin grid.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->adminServiceManagementService->getServiceRows();
    }

     /**
      * Update a service status from the admin grid actions.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request)
    {
        $action = $request->get("action");
        switch ($action) {
            case "status":
                return $this->adminServiceManagementService->updateStatus(
                    (string) $request->get("main_id"),
                    (string) $request->get("data_action")
                );
                break;

            default:
                break;
        }
    }

    public function showServiceList(Request $request)
    {
        $data = $this->adminServiceManagementService->getServiceDetail((string) $request->get('id'));

        return $data ?? [];
    }
}
