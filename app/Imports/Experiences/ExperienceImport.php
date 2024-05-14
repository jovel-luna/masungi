<?php

namespace App\Imports\Experiences;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\Experiences\Experience;

class ExperienceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		Experience::updateOrCreate([
    			'name' => $row['name'],
    		], [
    			'capacity_per_day' => $row['capacity_per_day'],
    			'operating_hours' => $row['operating_hours'],
    			'operating_hours_end' => $row['operating_hours_end'],

    		]);
    	}
    }
}