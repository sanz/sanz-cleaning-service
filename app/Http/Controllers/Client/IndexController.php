<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientHomeService;

class IndexController extends Controller
{
    public function __construct(private readonly ClientHomeService $clientHomeService)
    {
    }

    public function index()
    {
        $data = $this->clientHomeService->getHomePageData();

        return view('/pages/client_user/index')
        ->with('services', $data['services'])
        ->with('catalogs', $data['catalogs']);
    }
}
