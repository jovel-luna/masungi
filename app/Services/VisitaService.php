<?php

namespace App\Services;

use App\Traits\Curl;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Trails\Trail;

class VisitaService 
{
	use Curl;

	protected $url;
	protected $key;
	protected $secret;

	/**
     * Create new instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->url = config('visita.api_url');   
        $this->key = config('visita.api_key');   
        $this->secret = config('visita.api_secret');   
    }

    /**
     * Insert bookings, invoices and guests
     */
    public function insertBookings($request) 
    {
    	$capacity = 0;
        if($trail = Trail::where('name', $request['trail_name'])->first()) {
            $capacity = $trail->capacity_per_day;
        }

        $booking_url = $this->url.'book';
    	$header = [];
    	$payloads = [
    		'api_key' => $this->key, 
    		'api_secret' => $this->secret,
    		'start_time' => $request['start_time'],
    		'scheduled_at' => $request['scheduled_at'],
    		'total_guest' => $request['total_guest'],
    		'trail_name' => $request['trail_name'],
    		'guests' => $request['guests'],
    		'conservation_fee' => $request['conservation_fee'],
    		'conservation_fee_per_guest' => $request['conservation_fee_per_guest'],
    		'transaction_fee' => $request['transaction_fee'],
    		'sub_total' => $request['sub_total'],
    		'grand_total' => $request['grand_total'],
            'is_paypal_payment' => $request['is_paypal_payment'],
            'is_fullpayment' => $request['is_fullpayment'],
            'amount_settled' => $request['amount_settled'],
    		'balance' => $request['balance'],
		'capacity' => $capacity,
		'add_on_id' => $request['add_on_id'],
    	];

        Log::info($booking_url);
        Log::info($request);

    	$response = $this->postRequest($booking_url, $header, $payloads);
        Log::info('response here');
        Log::info($response);
    	return json_decode($response);
    }	

    /**
     * Update invoice
     */
    public function updateInvoice($request) {
        $booking_url = $this->url.'update';
        $header = [];
        $payloads = [
            'api_key' => $this->key, 
            'api_secret' => $this->secret,
            'reference_code' => $request['reference_code'],
            'payment_code' => $request['payment_code'],
        ];

        $response = $this->postRequest($booking_url, $header, $payloads);
        Log::info('Visita respone : '. $response);
        return json_decode($response);
    }   

    /**
     * Check if timeslot is not full
     */
    public function canAccomodateReservation($request) {
        $booking_url = $this->url.'canShow';
        $header = [];
        $payloads = [
            'api_key' => $this->key, 
            'api_secret' => $this->secret,
            'start_time' => $request['time'],
            'date' => $request['date'],
            'trail_name' => $request['trail_name'],
        ];

        $response = $this->postRequest($booking_url, $header, $payloads);
        Log::info('Visita respone : '. $response);
        return json_decode($response);
    }

    /**
     * Get all Available Monday Slots
     * **/
    public function  getAvailableSlots()
    {
        $booking_url = $this->url.'getMondaySlots';
        $header = [];
        $payloads = [
            'api_key' => $this->key, 
            'api_secret' => $this->secret
        ];

        $response = $this->postRequest($booking_url, $header, $payloads);
        Log::info('Visita response : '. $response);
        return json_decode($response);
    }

    /**
     * Check if Available Slots
     * **/
    public function  checkIfAvailable($request)
    {
        $booking_url = $this->url.'checkIfAvailable';
        $header = [];
        $payloads = [
            'api_key' => $this->key, 
            'api_secret' => $this->secret,
            'date' => $request['date'],
            'experience' => $request['experience']
        ];

        $response = $this->postRequest($booking_url, $header, $payloads);
        Log::info('Visita response : '. $response);
        return json_decode($response);
    }
}
