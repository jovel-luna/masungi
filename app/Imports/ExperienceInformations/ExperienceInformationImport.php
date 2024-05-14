<?php

namespace App\Imports\ExperienceInformations;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\ExperienceInformations\ExperienceInformation;


class ExperienceInformationImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		ExperienceInformation::updateOrCreate([
    			'experience_id' => $row['experience_id'],
    		], [
	            'duration' => $row['duration'],
	            'terrain' => $row['terrain'],
                'age_group' => $row['age_group'],
                'conservation_fees' => $row['conservation_fees'],
                'overview' => $row['overview'],
                'trail_characteristics' => $row['trail_characteristics'],
                'ideal_for' => $row['ideal_for'],
                'inclusions' => $row['inclusions'], 
                'good_to_know' => $row['good_to_know'],
                'conservation_fee_detail' => $row['conservation_fee_detail'],
                'visit_request' => $row['visit_request'], 

    		]);
    	}
    }
}


