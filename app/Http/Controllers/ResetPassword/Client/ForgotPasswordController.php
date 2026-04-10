<?php

namespace App\Http\Controllers\ResetPassword\Client;

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
        $this->middleware('guest:client');
    }

    public function showLinkRequestForm()
    {

        return view('/auth/passwords/client/forgot-password');
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['client_email' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        return $request->only('client_email');
    }
    public function broker()
    {
        return Password::broker('client');
    }
}
