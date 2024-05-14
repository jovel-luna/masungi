<?php

namespace App\Imports\Trails;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\Trails\Trail;

class TrailImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		Trail::updateOrCreate([
    			'experience_id' => $row['experience_id'],
    		], [
    			'name' => $row['name'],
                'description' => $row['description'],
                'weekday_fee' => $row['weekday_fee'],
                'weekend_fee' => $row['weekend_fee'],
                'fee_per_guest' => $row['fee_per_guest'],
                'estimated_duration' => $row['estimated_duration'],
                'recommended_for' => $row['recommended_for'],
                'minimum_participant' => $row['minimum_participant'],
    			'paypal_charges' => $row['paypal_charges'],
                'terrain' => $row['terrain'],
                'age_group' => $row['age_group'],
                'overview' => $row['overview'],
                'characteristic' => $row['characteristic'],
                'ideal_for' => $row['ideal_for'],
                'inclusions' => $row['inclusions'],
                'good_to_know' => $row['good_to_know'],
                'visit_request_process' => $row['visit_request_process'],
                'terms_and_condition' => $row['terms_and_condition'],
                'image_path' => $row['image_path'],
    		]);
    	}
    }
}