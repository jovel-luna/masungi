<?php

namespace App\Http\Controllers\Admin\ExperienceInformation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ExperienceInformations\ExperienceInformation;

use App\Http\Requests\Admin\ExperiencesInformation\ExperienceInformationStoreRequest;

use DB;

class ExperienceInformationController extends Controller
{

    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\ExperienceInformation\ExperienceInformationMiddleware', 
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
        return view('admin.experience-information.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.experience-information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceInformationStoreRequest $request)
    {
        DB::beginTransaction();
            $item = ExperienceInformation::store($request);
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
        $item = ExperienceInformation::withTrashed()->findOrFail($id);
        return view('admin.experience-information.show', [
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
    public function update(ExperienceInformationStoreRequest $request, $id)
    {
        $item = ExperienceInformation::withTrashed()->findOrFail($id);
        DB::beginTransaction();
            $item = ExperienceInformation::store($request, $item);
        DB::commit();

        $message = "You have successfully updated {$item->renderName()}";


        return response()->json([
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Experience  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = ExperienceInformation::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Experience  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = ExperienceInformation::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function removeImage(Request $request, $id)
    {
        $item = ExperienceInformation::withTrashed()->findOrFail($id);
        $message = "You have successfully remove the image in {$item->renderName()}";

        $result = $item->removeImage($request);

        return response()->json([
            'message' => $message,
        ]);
    }
}
