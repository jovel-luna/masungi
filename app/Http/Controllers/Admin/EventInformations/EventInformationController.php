<?php

namespace App\Http\Controllers\Admin\EventInformations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\EventInformations\EventInformationStoreRequest;

use App\Services\PushService;

use App\Models\EventInformations\EventInformation;
use DB;

class EventInformationController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\EventInformations\EventInformationMiddleware', 
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
        return view('admin.eventinformations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eventinformations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventInformationStoreRequest $request)
    {
        $item = EventInformation::store($request);

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
        $item = EventInformation::withTrashed()->findOrFail($id);
        return view('admin.eventinformations.show', [
            'item' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventInformation $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function update(EventInformationStoreRequest $request, $id)
    {
        $item = EventInformation::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        $item = EventInformation::store($request, $item);

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventInformation  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = EventInformation::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\EventInformation  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = EventInformation::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function removeImage(Request $request, $id)
    {
        $item = EventInformation::withTrashed()->findOrFail($id);
        $message = "You have successfully remove the image in {$item->renderName()}";

        $result = $item->removeImage($request);

        return response()->json([
            'message' => $message,
        ]);
    }
}

