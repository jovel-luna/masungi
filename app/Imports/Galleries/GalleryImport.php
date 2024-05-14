<?php

namespace App\Imports\Galleries;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Helpers\StringHelpers;

use App\Models\Galleries\Gallery;

class GalleryImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    	foreach ($rows as $row) {
    		Gallery::updateOrCreate([
                'category' => $row['category'],
    		], [
                'name' => $row['name'],
                'description' => $row['description'],             
                'image_path' => $row['image_path'],
    		]);
    	}
    }
}