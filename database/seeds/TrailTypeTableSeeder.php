<?php

use Illuminate\Database\Seeder;

use App\Models\Trails\TrailType;

class TrailTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
        	['name' => 'Day Trail'],
        	['name' => 'Night Trail'],
        	['name' => 'Day/Night Trail'],
        ];
        foreach($types as $type) {
		    TrailType::create([
		    	'name' => $type['name']
		    ]);
        }
    }
}
