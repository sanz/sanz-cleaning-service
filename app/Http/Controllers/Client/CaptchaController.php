<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
