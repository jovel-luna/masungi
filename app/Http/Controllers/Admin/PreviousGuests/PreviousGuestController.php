<?php

namespace App\Http\Controllers\Admin\PreviousGuests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\PreviousGuests\PreviousGuestStoreRequest;

use App\Services\PushService;

use App\Models\PreviousGuests\PreviousGuest;
use DB;

class PreviousGuestController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\PreviousGuests\PreviousGuestMiddleware', 
            ['only' => ['index', 'create', 'store', 'show', 'update', 'archive', 'restore']]
        );
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.previousguests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.previousguests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PreviousGuestStoreRequest $request)
    {
        $item = PreviousGuest::store($request);

        $message = "You have successfully created {$item->renderName()}";
        $redirect = $item->renderShowUrl();

        return response()->json([
            'message' => $message,
            'redirect' => $redirect,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PreviousGuest::withTrashed()->findOrFail($id);
        return view('admin.previousguests.show', [
            'item' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreviousGuest $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function update(PreviousGuestStoreRequest $request, $id)
    {
        $item = PreviousGuest::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        $item = PreviousGuest::store($request, $item);

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreviousGuest  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = PreviousGuest::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\PreviousGuest  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = PreviousGuest::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function removeImage(Request $request, $id)
    {
        $item = PreviousGuest::withTrashed()->findOrFail($id);
        $message = "You have successfully remove the image in {$item->renderName()}";

        $result = $item->removeImage($request);

        return response()->json([
            'message' => $message,
        ]);
    }
}

