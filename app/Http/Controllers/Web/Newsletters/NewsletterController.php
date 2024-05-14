<?php

namespace App\Http\Controllers\Web\Newsletters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Newsletters\Newsletter;
use App\Models\Users\Admin;

use DB;

use App\Notifications\Web\Newsletters\NewsletterNotification;
use App\Http\Requests\Web\Newsletters\NewsletterStoreRequest;


class NewsletterController extends Controller
{
    public function newsletterStore(NewsletterStoreRequest $request) 
    {
    	$admins = Admin::all();
    	// $admins = Admin::first();
    	DB::beginTransaction();
    		$item = Newsletter::store($request);

    		foreach ($admins as $admin) {
    			// $admin->notify(new NewsletterNotification('Newsletter', $request));
    		}
    		// $admins->notify(new NewsletterNotification('Newsletter', $request));
    	DB::commit();

    	return response()->json([
    		'message'=>'success'
    	]);
    }
}
