<?php

namespace App\Imports\Carousels;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\Carousels\Carousel;

class DestinationCarouselImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		Carousel::updateOrCreate([
                'name' => $row['name'],
    		], [
                'image_path' => $row['image_path'],
    		]);
    	}
    }
}
