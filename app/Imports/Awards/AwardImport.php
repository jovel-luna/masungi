<?php

namespace App\Imports\Awards;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\Awards\Award;

class AwardImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		Award::updateOrCreate([
                'title' => $row['title'],
    		], [
                'image_path' => $row['image_path'],
    		]);
    	}
    }
}