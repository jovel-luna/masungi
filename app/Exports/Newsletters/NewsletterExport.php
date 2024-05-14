<?php

namespace App\Exports\Newsletters;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Http\JsonResponse;

class NewsletterExport implements FromArray, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{

    protected $items;

    public function __construct($items)
    {
      $this->items =$items;

    }

    public function array(): array
    {
    	$result = [];
      
    	foreach ($this->items as $item) {
            
                                
               $result[] = [
                        '#' => $item->id,
                        'email' => $item->email,
                ];
    	}
         return $result;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Email',
        ];
    }
}
