<?php

use Illuminate\Database\Seeder;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Imports\OldNewCarousels\OldNewCarouselImport;

class OldNewCarouselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::beginTransaction();

        Excel::import(new OldNewCarouselImport, storage_path('imports/oldnewcarousel.xls'));

        DB::commit();
    }
}
