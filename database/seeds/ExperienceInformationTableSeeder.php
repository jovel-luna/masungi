<?php

use Illuminate\Database\Seeder;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Imports\ExperienceInformations\ExperienceInformationImport;

class ExperienceInformationTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::beginTransaction();

        Excel::import(new ExperienceInformationImport, storage_path('imports/experience-information.xls'));

        DB::commit();
    }
}
