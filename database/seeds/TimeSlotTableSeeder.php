<?php

use Illuminate\Database\Seeder;

use App\Models\TimeSlots\TimeSlot;

class TimeSlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeSlot::truncate();

        $row = 0;
        
        if(($handle = fopen('database/csv/time_slots.csv', "r")) !== FALSE){
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            	if ($row > 0) {
	                $this->command->info('writing row ' . $row . ' ' . $data[0]);

	                $item = new TimeSlot();
	                $item->trail_type_id = $data[0];
                    $item->time = $data[1];
                    $item->day_week_name = $data[2];
	                $item->order = $data[3];

	                $item->save();
            	}

                $row++;

            }
            fclose($handle);
        }
    }
}
