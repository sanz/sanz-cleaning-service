<?php

namespace App\Http\Controllers;

use App\Jobs\ContactMailJob;
use App\Services\Client\ClientHomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    public function aboutUs()
    {
        return view('/pages/client_user/about-us');
    }

    public function contacts()
    {
        return view('/pages/client_user/contacts');
    }

    public function storeContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        dispatch(new ContactMailJob($data));

        return back()->with('msg', 'Your Message has send Successfully!');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}