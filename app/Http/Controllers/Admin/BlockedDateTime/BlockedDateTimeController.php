<?php

namespace App\Http\Controllers\Admin\BlockedDateTime;

// use Illuminate\Http\Request;
use App\Http\Requests\Admin\Dates\BlockedDateTimeStoreRequest as Request;
use App\Http\Controllers\Controller;

use App\Models\BlockedDateAndTime\BlockedDateTime;
use App\Models\TimeSlots\TimeSlot;

use DB;

class BlockedDateTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blocked-dates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blocked-dates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
            $item = BlockedDateTime::store($request);
            $item->timeSlots()->attach($request->time_list);
            // foreach ($request->time_list as $time) {
            //     TimeSlot::find($time)->update(['is_block' => true]);
            // }
        DB::commit();

        $message = "You have successfully created {$item->reason}";
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
        $item = BlockedDateTime::withTrashed()->findOrFail($id);
        return view('admin.blocked-dates.show', [
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
        $item = BlockedDateTime::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->reason}";

        DB::beginTransaction();
            $item = BlockedDateTime::store($request, $item);
            $item->timeSlots()->sync($request->time_list);
            // foreach ($request->time_list as $time) {
            //     TimeSlot::find($time)->update(['is_block' => true]);
            // }
        DB::commit();

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Destination  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = BlockedDateTime::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->reason}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Destination  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = BlockedDateTime::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->reason}",
        ]);
    }
}
