<?php

namespace App\Http\Controllers\Web\Inquiries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactUs\ContactUs;
use App\Models\CompanyInquiries\CompanyInquiry;
use App\Models\SchoolInquiries\SchoolInquiry;
use App\Models\WeddingInquiries\WeddingInquiry;
use App\Models\Users\Admin;

use DB;

use App\Notifications\Web\Inquiry\UserInquiryNotification;
use App\Notifications\Web\Inquiry\CompanyInquiryNotification;
use App\Notifications\Web\Inquiry\SchoolInquiryNotification;
use App\Notifications\Web\Inquiry\WeddingInquiryNotification;

use App\Http\Requests\Web\Inquiries\ContactUsStoreRequest;
use App\Http\Requests\Web\Inquiries\CompanyInquiryStoreRequest;
use App\Http\Requests\Web\Inquiries\SchoolInquiryStoreRequest;
use App\Http\Requests\Web\Inquiries\WeddingInquiryStoreRequest;

class InquiryController extends Controller
{
    public function contactUsStore(ContactUsStoreRequest $request) 
    {
    	$admins = Admin::all();
    	// $admins = Admin::first();
    	DB::beginTransaction();
    		$item = ContactUs::store($request);

    		foreach ($admins as $admin) {
    			$admin->notify(new UserInquiryNotification('Contact Us', $request, $item));
    		}
    		// $admins->notify(new UserInquiryNotification('Contact Us', $request));
    	DB::commit();

    	return response()->json([
    		'message'=>'success'
    	]);
    }

    public function companyInquiry(CompanyInquiryStoreRequest $request) {
    	$admins = Admin::all();
    	// $admins = Admin::first();
    	DB::beginTransaction();
    		$item = CompanyInquiry::store($request);

    		foreach ($admins as $admin) {
    			$admin->notify(new CompanyInquiryNotification('Company Inquiry', $request, $item));
    		}
    		// $admins->notify(new UserInquiryNotification('Contact Us', $request));
    	DB::commit();

    	return response()->json([
    		'message'=>'success'
    	]);
    }

    public function schoolInquiry(SchoolInquiryStoreRequest $request) {
        $admins = Admin::all();
        // $admins = Admin::first();
        DB::beginTransaction();
            $item = SchoolInquiry::store($request);
            // $admins->notify(new UserInquiryNotification('Contact Us', $request));
        DB::commit();

        foreach ($admins as $admin) {
            $admin->notify(new SchoolInquiryNotification('School Inquiry', $request, $item->trail, $item));
        }
        return response()->json([
            'message'=>'success'
        ]);
    }


    public function weddingInquiry(WeddingInquiryStoreRequest $request) {
        $admins = Admin::all();
        // $admins = Admin::first();
        DB::beginTransaction();
            $item = WeddingInquiry::store($request);
            // $admins->notify(new UserInquiryNotification('Contact Us', $request));
        DB::commit();

        foreach ($admins as $admin) {
            $admin->notify(new WeddingInquiryNotification('Wedding Inquiry', $request, $item));
        }
        return response()->json([
            'message'=>'success'
        ]);
    }
}
