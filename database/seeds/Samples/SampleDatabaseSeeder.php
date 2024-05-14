<?php

use Illuminate\Database\Seeder;

class SampleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(PagesTableSeeder::class);
        $this->call(AwardTableSeeder::class);
        $this->call(GalleryTableSeeder::class);
        $this->call(OldNewCarouselTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(ExperienceTableSeeder::class);
        $this->call(TrailTableSeeder::class);
        $this->call(ExperienceInformationTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);        
        $this->call(TrailTypeTableSeeder::class);        
        $this->call(BlockDateTimeTableSeeder::class);        
        $this->call(TimeSlotTableSeeder::class);        
        // $this->call(SampleItemsTableSeeder::class);
        // $this->call(SampleItemRelationshipsTableSeeder::class);
        // $this->call(SampleArticlesTableSeeder::class);
        // $this->call(SampleAdminsTableSeeder::class);
        // $this->call(SampleUsersTableSeeder::class);



    }
}
