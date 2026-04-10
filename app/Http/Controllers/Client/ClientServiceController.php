<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Client\ClientServiceManagementService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientServiceController extends Controller
{
    public function __construct(private readonly ClientServiceManagementService $clientServiceManagementService)
    {
        $this->middleware('auth:client');
    }

    public function index(Request $request)
    {
        $passArr = [];
        $passArr['breadcrumbs'] = [
            ['link' => '/clients/dashboard', 'name' => 'Dashboard'],
            ['link' => '/clients/services', 'name' => 'Service Listing'],
            ['name' => 'Add Service Listing'],
        ];

        $passArr['serviceList'] = $this->clientServiceManagementService->getServiceCatalogOptions();

        try {
            $id = (int) $request->id;
            if ($id <= 0) {
                throw new Exception('Invalid service id');
            }

            $serviceData = $this->clientServiceManagementService->getServiceById($id);
            if (!empty($serviceData)) {
                $passArr['serviceData'] = $serviceData;
            }
        } catch (Exception $e) {
        }

        return view('/pages/client_user/client/client-add-service-listing', $passArr);
    }

    public function serviceListing()
    {
        $breadcrumbs = [['link' => '/clients/dashboard', 'name' => 'Dashboard'], ['name' => 'Service Listing']];
        $data = $this->clientServiceManagementService->getClientServiceListing((int) Auth::id());

        return view('/pages/client_user/client/client-service-listing', [
            'breadcrumbs' => $breadcrumbs,
        ])->with('serviceList', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'provider_name' => 'required',
            'ser_exp' => 'required',
            'ser_img' => 'required',
            'ser_doc_no' => 'required',
            'doc_img' => 'required',
        ]);

        $this->clientServiceManagementService->createService((int) Auth::id(), $request->all());

        return true;
    }

    public function show(Service $service, Request $request)
    {
        $id = (int) $request->get('id');
        $data = $this->clientServiceManagementService->getServiceById($id);

        return json_encode($data ?? []);
    }

    public function update(Request $request, Service $service)
    {
        $action = $request->get('action');
        $id = (int) $request->get('id');

        switch ($action) {
            case 'update':
                $this->clientServiceManagementService->updateService(
                    (int) Auth::id(),
                    $id,
                    $request->all()
                );
                break;

            case 'status':
                $nextStatus = $this->clientServiceManagementService->toggleStatus(
                    $id,
                    (string) $request->get('status')
                );
                if ($nextStatus === null) {
                    break;
                }
                return $nextStatus;
        }

        return true;
    }

    public function saveImg(Request $request)
    {
        $path = [];
        if ($request->hasFile('ser_img')) {
            $imgFile = $request->file('ser_img');
            $path['ser_img'] = $this->saveImgToStorage($imgFile, 'images/client/ser_img');
        }
        if ($request->hasFile('ser_doc_img')) {
            $imgFile = $request->file('ser_doc_img');
            $path['doc_img'] = $this->saveImgToStorage($imgFile, 'images/client/ser_doc_img');
        }
        return $path;
    }

    private function saveImgToStorage($imgFile, $saveImgPath)
    {
        $ext = $imgFile->getClientOriginalExtension();
        $newImgName = rand() . '-' . time() . '.' . $ext;
        $imgFile->move(public_path($saveImgPath), $newImgName);
        return $saveImgPath . '/' . $newImgName;
    }
}
