<?php

namespace App\Http\Controllers\ResetPassword\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    public function showLinkRequestForm()
    {

        return view('/auth/passwords/customer/forgot-password');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['user_email' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        return $request->only('user_email');
    }
    public function broker()
    {
        return Password::broker('customer');
    }
}
