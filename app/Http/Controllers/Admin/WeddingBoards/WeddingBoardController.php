<?php

namespace App\Http\Controllers\Admin\WeddingBoards;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\WeddingBoards\WeddingBoardStoreRequest;

use App\Services\PushService;

use App\Models\WeddingBoards\WeddingBoard;
use DB;

class WeddingBoardController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\WeddingBoards\WeddingBoardMiddleware', 
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
        return view('admin.weddingboards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weddingboards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeddingBoardStoreRequest $request)
    {
        $item = WeddingBoard::store($request);

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
        $item = WeddingBoard::withTrashed()->findOrFail($id);
        return view('admin.weddingboards.show', [
            'item' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeddingBoard $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function update(WeddingBoardStoreRequest $request, $id)
    {
        $item = WeddingBoard::withTrashed()->findOrFail($id);
        $message = "You have successfully updated {$item->renderName()}";

        $item = WeddingBoard::store($request, $item);

        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeddingBoard  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = WeddingBoard::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\WeddingBoard  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = WeddingBoard::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function removeImage(Request $request, $id)
    {
        $item = WeddingBoard::withTrashed()->findOrFail($id);
        $message = "You have successfully remove the image in {$item->renderName()}";

        $result = $item->removeImage($request);

        return response()->json([
            'message' => $message,
        ]);
    }
}

