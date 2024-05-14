<?php

namespace App\Http\Controllers\Admin\EventTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\EventTypes\EventType;

use App\Http\Requests\Admin\EventTypes\EventTypeStoreRequest;

use DB;

class EventTypeController extends Controller
{

    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\EventTypes\EventTypeMiddleware', 
            ['only' => ['index', 'create', 'store', 'show', 'update', 'archive', 'restore', 'removeImage']]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.eventtypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eventtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventTypeStoreRequest $request)
    {
        DB::beginTransaction();
            $item = EventType::store($request);
        DB::commit();
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
        $item = EventType::withTrashed()->findOrFail($id);
        return view('admin.eventtypes.show', [
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventTypeStoreRequest $request, $id)
    {
        $item = EventType::withTrashed()->findOrFail($id);
        DB::beginTransaction();
            $item = EventType::store($request, $item);
        DB::commit();

        $message = "You have successfully updated {$item->renderName()}";


        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = EventType::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Event  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = EventType::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

}
