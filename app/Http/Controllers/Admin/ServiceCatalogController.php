<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminServiceCatalogManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        private readonly AdminServiceCatalogManagementService $adminServiceCatalogManagementService
    ) {
        $this->middleware("auth");
    }

    public function index()
    {
        $services = $this->adminServiceCatalogManagementService->getAllCatalogs();

        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => "Home"], ['name' => "Service Catalog"]
        ];

        return view('/pages/service-catalog', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services
        ]);
    }

    public function retrieve(Request $request)
    {
        $services = $this->adminServiceCatalogManagementService->getAllCatalogs();

        return $services->map(function ($service) {
            $path = $service->service_image;
            $service->service_image_url = $path ? asset('storage/' . ltrim($path, '/')) : null;
            return $service;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'service_category' => 'required',
            'service_image' => 'required'
        ]);

        return $this->adminServiceCatalogManagementService->createCatalog($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->action) {
            case "service":
                $rules = array(
                    'service_name' => 'required',
                    'service_category' => 'required',
                );
                $id = $request->id;
                $tmp = $request->all();
                $error = Validator::make($tmp, $rules);
                if ($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }
                return $this->adminServiceCatalogManagementService->updateByAction('service', $tmp);
            case "status":
                return $this->adminServiceCatalogManagementService->updateByAction('status', $request->all());
            case "status-enable":
                return $this->adminServiceCatalogManagementService->updateByAction('status-enable', $request->all());
            case "status-disable":
                return $this->adminServiceCatalogManagementService->updateByAction('status-disable', $request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->adminServiceCatalogManagementService->deleteCatalog((int) $request->id);
    }

    /** Image Save */
    public function saveImg(Request $request)
    {
        $request->validate([
            'service_image' => 'required|mimes:jpg,jpeg,png,gif,webp,svg,jfif'
        ]);
        $path = "";
        if ($request->hasFile('service_image')) {
            $path = $request->service_image->store('service-images', 'public');
        }
        return $path;
    }
}
