<?php

namespace App\Imports\OldNewCarousels;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\OldNewCarousels\OldNewCarousel;

class OldNewCarouselImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		OldNewCarousel::updateOrCreate([
                'name' => $row['name'],
    		], [
                'new_image_path' => $row['new_image_path'],
                'old_image_path' => $row['old_image_path'],                
    		]);
    	}
    }
}