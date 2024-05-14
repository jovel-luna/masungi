<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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
        $this->call(PagesTableSeeder::class);
    }
}
