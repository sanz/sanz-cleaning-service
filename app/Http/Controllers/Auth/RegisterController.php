<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\WelcomeMailJob;
use App\Services\Auth\RegistrationService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct(private readonly RegistrationService $registrationService)
    {
        $this->middleware('guest');
        $this->middleware('guest:client');
        $this->middleware('guest:customer');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return $this->registrationService->createAdminUser($data);
    }

    public function showRegistrationForm()
    {
        $pageConfigs = [
            'bodyClass' => 'bg-full-screen-image',
            'blankPage' => true,
        ];

        return view('/auth/register', [
            'pageConfigs' => $pageConfigs,
        ]);
    }

    public function showClientRegisterForm()
    {
        return view('pages.client_user.client-register');
    }

    protected function createClient(Request $request)
    {
        $request->validate([
            'captcha' => ['required', 'captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\\Models\\Client,client_email'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $this->registrationService->createClient($request->all());

        if (
            Auth::guard('client')->attempt(
                ['client_email' => $request->email, 'password' => $request->password],
                $request->get('remember')
            )
        ) {
            dispatch(new WelcomeMailJob($request->all()));
            return redirect()->intended(route('clients.dashboard'));
        }

        return redirect()->intended(route('auth.login'));
    }

    public function showCustomerRegisterForm()
    {
        return view('pages.client_user.user-register');
    }

    protected function createCustomer(Request $request)
    {
        $request->validate([
            'captcha' => ['required', 'captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\\Models\\Customer,user_email'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $this->registrationService->createCustomer($request->all());

        if (
            Auth::guard('customer')->attempt(
                ['user_email' => $request->email, 'password' => $request->password],
                $request->get('remember')
            )
        ) {
            return redirect()->intended(route('home'));
        }

        return redirect()->intended(route('auth.login'));
    }
}
