<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function __construct(private readonly CustomerReviewService $customerReviewService)
    {
        $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
        $serviceId = (int) $request->id;
        if ($serviceId <= 0) {
            return view('/pages/error-404');
        }

        $customerId = (int) Auth::guard('customer')->user()->id;
        $data = $this->customerReviewService->getReviewPageData($serviceId, $customerId);

        if (!$data['checkOrder']) {
            return back()
            ->withErrors(['error' => "you can't leave a reaview because You did't Book this service yet !"]);
        }

        return view('pages/client_user/user/user-review')
                ->with('checkReview', $data['checkReview'])
                ->with('service', $data['service'])
                ->with('serviceId', $data['serviceId']);
    }

    public function submit(Request $request)
    {
        $serviceId = (int) $request->id;
        if ($serviceId <= 0) {
            return view('/pages/error-404');
        }

        $request->validate([
            'resp_revw' => 'required' ,
            'serv_revw' => 'required' ,
            'comm_revw' => 'required' ,
            'price_revw' => 'required' ,
            'revw_title' => 'required' ,
            'revw_text' => 'required' ,
            'revw_fileupload' => 'image'
        ]);

        $data = [
            'resp_revw' => $request->resp_revw,
            'serv_revw' => $request->serv_revw,
            'comm_revw' => $request->comm_revw,
            'price_revw' => $request->price_revw,
            'revw_title' => $request->revw_title,
            'revw_text' => $request->revw_text,
        ];
        if ($request->hasFile('revw_fileupload')) {
            $data['image'] = $request->revw_fileupload->store('/images/reviews');
        }

        $this->customerReviewService->submitReview($serviceId, (int) Auth::guard('customer')->user()->id, $data);
        session()->flash('msg', 'Review Submitted Successfully!');

        return redirect()->route('customers.clients.show', ['id' => $request->id]);
    }

    public function update(Request $request)
    {
        $serviceId = (int) $request->id;
        if ($serviceId <= 0) {
            return view('/pages/error-404');
        }

        $request->validate([
            'resp_revw' => 'required' ,
            'serv_revw' => 'required' ,
            'comm_revw' => 'required' ,
            'price_revw' => 'required' ,
            'revw_title' => 'required' ,
            'revw_text' => 'required' ,
            'revw_fileupload' => 'image'
        ]);

        $data = [
            'resp_revw' => $request->resp_revw,
            'serv_revw' => $request->serv_revw,
            'comm_revw' => $request->comm_revw,
            'price_revw' => $request->price_revw,
            'revw_title' => $request->revw_title,
            'revw_text' => $request->revw_text,
        ];

        if ($request->hasFile('revw_fileupload')) {
            $data['image'] = $request->revw_fileupload->store('/images/reviews');
        }

        $this->customerReviewService->updateReview(
            $serviceId,
            (int) Auth::guard('customer')->user()->id,
            $data
        );

        session()->flash('msg', 'Review Updated Successfully!');

        return redirect()->route('customers.clients.show', ['id' => $request->id]);
    }
}
