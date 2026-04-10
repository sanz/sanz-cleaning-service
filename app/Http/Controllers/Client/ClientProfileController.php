<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\ClientProfileService as ClientProfileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientProfileController extends Controller
{
    public function __construct(private readonly ClientProfileManager $clientProfileService)
    {
        $this->middleware("auth:client");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clientData = $this->getClientData((int) Auth::id());

        $breadcrumbs = [['link' => "/clients/dashboard", 'name' => "Dashboard"], ['name' => "My Profile"]];
        return view('/pages/client_user/client/client-profile', [
            'breadcrumbs' => $breadcrumbs,
            'clientData' => $clientData
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
        * @param  mixed  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientProfile)
    {
        $action = $request->action;
        switch ($action) {
            case 'detail':
                $data = array(
                    // 'client_name' => trim($request->get('client_fname')) . " " . trim($request->get('client_lname')),
                    'client_name' => trim($request->get('client_name')),
                    'client_email' => trim($request->get('client_email')),
                    'client_mobile' => trim($request->get('client_mo')),
                    'client_gender' => trim($request->get('gender')),
                    'client_photo_url' => trim($request->get('client_img')),
                );
                $this->clientProfileService->updateProfileDetails((int) Auth::id(), $data);
                return redirect(route('clients.dashboard'));
                break;

            case 'password':
                $old_password = $request->get("old_password");
                $new_password = $request->get("new_password");

                $current_password = Auth::User()->password;
                if (Hash::check($old_password, $current_password)) {
                    $user_id = Auth::User()->id;
                    $this->clientProfileService->updatePassword((int) $user_id, Hash::make($new_password));
                }
                return redirect(route('clients.profile.index'));
                break;
        }
    }

    /** Image Save */
    public function saveImg(Request $request)
    {
        $path = "";
        if ($request->hasFile('client_img')) {
            $imgFile = $request->file('client_img');
            $path = $this->saveImgToStorage($imgFile, 'images/client/profile');
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

    /** Verify Password */
    public function verifyPassword(Request $request)
    {
        $current_password = Auth::User()->password;
        if (Hash::check($request->get('password'), $current_password)) {
            return true;
        } else {
            return false;
        }
    }

    /** Get Client Data */
    public function getClientData($client_id)
    {
        return $this->clientProfileService->getClientProfileData((int) $client_id);
    }
}
