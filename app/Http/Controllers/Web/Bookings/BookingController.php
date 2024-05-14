<?php

namespace App\Http\Controllers\Web\Bookings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\VisitaService;

class BookingController extends Controller
{
	protected $visita;

	/**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(VisitaService $visita)
    {
        $this->visita = $visita;
    }

	public function insertBooking(Request $request) {

    	$data = $this->visita->insertBookings($request->all());

    	return response()->json([
    		'visita_message' => $data
    	]);
    }

    public function getAvailableMondaySlots() {

    	$data = $this->visita->getAvailableSlots();

    	return response()->json($data);
    }

    public function checkIfAvailable(Request $request) {

    	$data = $this->visita->checkIfAvailable($request->all());

    	return response()->json($data);
    }
}
