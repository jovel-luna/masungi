<?php

namespace App\Http\Controllers\Admin\Newsletters;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\Newsletters\NewsletterFetchController;
use App\Models\Newsletters\Newsletter;
use App\Exports\Newsletters\NewsletterExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

use Excel;

class NewsletterController extends Controller
{
    public function __construct() {
        $this->middleware('App\Http\Middleware\Admin\Newsletters\NewsletterMiddleware', 
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
        return view('admin.newsletters.index');
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
        $item = Newsletter::withTrashed()->findOrFail($id);
        return view('admin.newsletters.show', [
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
     * @param  \App\Newsletters  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = Newsletter::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Newsletters  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = Newsletter::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->renderName()}",
        ]);
    }

    public function exportNewsletter(Request $request)
    {
        $controller = new NewsletterFetchController;

        $request = $request->merge(['nopagination' => 1]);
        $request = $request->merge(['nonegative' => 1]);
        $request = $request->merge(['ids_only' => 1]);

        $data = $controller->fetch($request);
        $message = 'Exporting data, please wait...';

        $data = Newsletter::whereIn('id', $data)->get();

        if (!count(array($data))) {
            throw ValidationException::withMessages([
                'items' => 'No email available.',
            ]);
        }

        if (!$request->ajax()) {
        
            return Excel::download(new NewsletterExport($data), 'Newsletter' . Carbon::now()->toDateTimeString() . '.xlsx');
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
            ]);
        }
    }

}
