<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\Admin\AdminCustomerManagementService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private readonly AdminCustomerManagementService $adminCustomerManagementService)
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
        $breadcrumbs = [['link' => "admindashboard", 'name' => "Home"], ['name' => "Customers"]];
        return view('/pages/user-manage', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $this->adminCustomerManagementService->getCustomerRows();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        switch ($request->action) {
            case 'status':
                $this->adminCustomerManagementService->updateUserStatus(
                    (string) $request->id,
                    (string) $request->hasClass
                );
                break;
        }
        return true;
    }

    public function showUserData(Request $request)
    {
        return $this->adminCustomerManagementService->getUserData((string) $request->get('id'));
    }
}
