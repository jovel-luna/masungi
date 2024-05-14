<?php

use Illuminate\Database\Seeder;

use App\Models\BlockedDateAndTime\BlockedDateTime;

class BlockDateTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        
        if(($handle = fopen('database/csv/blocked_date_times.csv', "r")) !== FALSE){
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            	if ($row > 0) {
	                $this->command->info('writing row ' . $row . ' ' . $data[0]);

	                $item = new BlockedDateTime();
	                $item->reason = $data[0];
	                $item->description = $data[1];
	                $item->date = $data[2];
                    $item->is_whole_day = $data[3];
                    $item->trail_id = $data[4];

	                $item->save();
            	}

                $row++;

            }
            fclose($handle);
        }
    }
}
