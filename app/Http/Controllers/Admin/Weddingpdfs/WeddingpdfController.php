<?php

namespace App\Http\Controllers\Admin\Weddingpdfs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Weddingpdfs\WeddingpdfStoreRequest;

use App\Services\PushService;

use App\Models\Weddingpdfs\Weddingpdf;
use DB;

class WeddingpdfController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\Weddingpdfs\WeddingpdfMiddleware', 
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
        return view('admin.weddingpdfs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weddingpdfs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeddingpdfStoreRequest $request)
    {
        $item = Weddingpdf::store($request);

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
        $item = Weddingpdf::withTrashed()->findOrFail($id);
        return view('admin.weddingpdfs.show', [
            'item' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Weddingpdf $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function update(WeddingpdfStoreRequest $request, $id)
    {
        $item = Weddingpdf::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        $item = Weddingpdf::store($request, $item);

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Weddingpdf  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = Weddingpdf::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Weddingpdf  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = Weddingpdf::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function removeImage(Request $request, $id)
    {
        $item = Weddingpdf::withTrashed()->findOrFail($id);
        $message = "You have successfully remove the image in {$item->renderName()}";

        $result = $item->removeImage($request);

        return response()->json([
            'message' => $message,
        ]);
    }
}

