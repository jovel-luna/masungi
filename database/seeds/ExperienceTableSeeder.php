<?php

use Illuminate\Database\Seeder;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Imports\Experiences\ExperienceImport;

class ExperienceTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::beginTransaction();

        Excel::import(new ExperienceImport, storage_path('imports/experience.xls'));

        DB::commit();
    }
}
