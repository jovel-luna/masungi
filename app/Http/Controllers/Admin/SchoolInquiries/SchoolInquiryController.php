<?php

namespace App\Http\Controllers\Admin\SchoolInquiries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SchoolInquiries\SchoolInquiry;

class SchoolInquiryController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\SchoolInquiries\SchoolInquiryMiddleware', 
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
        return view('admin.schoolinquiries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = SchoolInquiry::withTrashed()->findOrFail($id);
        return view('admin.schoolinquiries.show', [
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolInquiry  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = SchoolInquiry::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\SchoolInquiry  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = SchoolInquiry::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }
}
