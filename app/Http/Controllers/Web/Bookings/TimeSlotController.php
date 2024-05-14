<?php

namespace App\Http\Controllers\Web\Bookings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlockedDateAndTime\BlockedDateTime;
use App\Services\VisitaService;

use App\Models\TimeSlots\TimeSlot;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TimeSlotController extends Controller
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


    public function getTimeslots(Request $request) {
    	$date = $request->date;
        $trail_id = $request->trail_id;
    	$dayType = Carbon::parse($date)->isWeekend() ? 'Weekend & Holidays' : 'Weekdays';
    	$slots = TimeSlot::where('day_week_name', $dayType)->whereHas('trail', function($query) use($trail_id) {
            $query->where('id', $trail_id);
        })->orderby("order", "asc")->get();
    	$timeslots = [];
		$wholeDayBlocked = BlockedDateTime::where('date', $request->date)
                        ->where('trail_id', $trail_id)
						->where('is_whole_day', 1)
						->exists();

    	foreach ($slots as $slot) {
    		if(count($timeslots) <= 4) {
    			if(!$slot->blocks->where('date', $date)->first() && !$wholeDayBlocked) {
    				$request['time'] = $slot->time;
			    	$data = $this->visita->canAccomodateReservation($request->all());
			    	if($data == 'true') {
			    		array_push($timeslots, [
			    			'time' => $slot->time,
			    			'formatted_time' => $slot->formatted_time,
			    			'type' => $slot->day_week_name,
			    			'trail_type_id' => $slot->trail_type_id
			    		]);
			    	}
    			}
    		}
    	}

    	return response()->json([
    		'timeslots' => $timeslots
    	]);
    }

	public function getFullyBookedDates(Request $request) {
        $trail_id = $request->trail_id;
    	$dates = CarbonPeriod::create(Carbon::now(), Carbon::now()->addMonths(6));
		$dates->toArray();
		$fullyBookedDates = [];

		foreach ($dates as $key => $date) {
			$dayType = Carbon::parse($date)->isWeekend() ? 'Weekend & Holidays' : 'Weekdays';
			$slots = TimeSlot::where('day_week_name', $dayType)->whereHas('trail', function($query) use($trail_id) {
				$query->where('id', $trail_id);
			})->orderby("order", "asc")->get();
			$timeslots = [];
			$formattedDate = $date->format('Y-m-d');
			$wholeDayBlocked = BlockedDateTime::where('date', $formattedDate)
							->where('trail_id', $trail_id)
							->where('is_whole_day', 1)
							->exists();

			foreach ($slots as $slot) {
				if(!$slot->blocks->where('date', $date)->first() && !$wholeDayBlocked) {
					$request['time'] = $slot->time;
					$request['date'] = $formattedDate;
					$data = $this->visita->canAccomodateReservation($request->all());
					if($data == 'true') {
						array_push($timeslots, [
							'time' => $slot->time,
							'trail_type_id' => $slot->trail_type_id
						]);
					}
				}
			}

			if(!$timeslots) {
				$fullyBookedDates[] = $date->format('Y-m-d');
			}
		}

    	return response()->json([
    		'fully_booked_dates' => $fullyBookedDates,
    	]);
    }

}
