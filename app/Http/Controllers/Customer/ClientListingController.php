<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerClientListingService;
use Illuminate\Http\Request;

class ClientListingController extends Controller
{
    public function __construct(private readonly CustomerClientListingService $clientListingService)
    {
    }

    public function index(Request $request)
    {
        $data = $this->clientListingService->getIndexData();

        return view('/pages/client_user/user/client-listing')
            ->with('services', $data['services'])
            ->with('catalogs', $data['catalogs'])
            ->with('selectId', $data['selectId']);
    }

    public function filter(Request $request)
    {
        $catalogId = (int) $request->id;
        if ($catalogId <= 0) {
            return view('/pages/error-404');
        }

        $data = $this->clientListingService->getFilteredData($catalogId);

        return view('/pages/client_user/user/client-listing')
            ->with('services', $data['services'])
            ->with('catalogs', $data['catalogs'])
            ->with('selectId', $data['selectId']);
    }
}
