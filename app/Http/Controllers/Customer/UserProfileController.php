<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(private readonly CustomerProfileService $customerProfileService)
    {
        $this->middleware("auth:customer");
    }


    public function index()
    {
        return view('/pages/client_user/user/user-profile');
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
      */
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
           'user_name' => ['required', 'string', 'max:255'],
              'user_email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('customers', 'user_email')->ignore($customer?->id)
              ],
           'user_mobile' => ['required', 'numeric', 'digits:10'],
        ]);

        $tmp = $request->all();
        foreach ($tmp as $key => $value) {
            if (!$value || $key == "_token") {
                unset($tmp[$key]);
            }
        }
        
        // password checking open
        if ($request->oldpassword || $request->password || $request->password_confirmation) {
            $request->validate([
                'oldpassword' => ['required', 'string', 'min:6'],
                'password' => ['required', 'string', 'min:6', 'confirmed']
            ]);

            if ($this->customerProfileService->checkOldPassword($tmp['oldpassword'], (string) $customer?->password)) {
                $tmp['password'] = $this->customerProfileService->makePasswordHash($tmp['password']);
            } else {
                return back()->withErrors(['password' => 'Old Password Does not match with records.']);
            }

            unset($tmp['oldpassword']);
            unset($tmp['password_confirmation']);
        }

        // password checking close
        $this->customerProfileService->updateProfile((int) Auth::guard('customer')->user()->id, $tmp);
        session()->flash('status', 'Updated successfuliy!');
        return back();
    }
}
