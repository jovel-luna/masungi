<?php

namespace App\Http\Controllers\Admin\TimeSlots;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\TimeSlots\TimeSlot;
use App\Models\Trails\Trail;

class TimeSlotController extends Controller
{
    public function __construct() {
    $this->middleware('App\Http\Middleware\Admin\TimeSlots\TimeSlotMiddleware', 
        ['only' => ['index', 'create', 'store', 'show', 'update', 'archive', 'restore']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.time-slots.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.time-slots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = TimeSlot::store($request);

        $message = "You have successfully created {$item->renderTime()}";
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
        $item = TimeSlot::withTrashed()->findOrFail($id);
        return view('admin.time-slots.show', [
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
    public function update(Request $request, $id)
    {
        $item = TimeSlot::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderTime()}";

        $item = TimeSlot::store($request, $item);

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeSlot  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = TimeSlot::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderTime()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\TimeSlot  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = TimeSlot::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderTime()}",
        ]);
    }

    public function reOrder(Request $request) {
        foreach ($request->items as $key => $item) {

            $timeslot = TimeSlot::find($item['id']);

            if($timeslot) {
                $timeslot->update(['order' => $key ]);
            }

        }

        return response()->json([
            'message' => 'Successfully updated the order of time slot',
        ]);
    }
}
