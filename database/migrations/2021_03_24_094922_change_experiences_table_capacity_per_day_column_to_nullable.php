<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExperiencesTableCapacityPerDayColumnToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            DB::statement('ALTER TABLE `experiences` MODIFY `capacity_per_day` INTEGER(11) NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            DB::statement('ALTER TABLE `experiences` MODIFY `capacity_per_day` INTEGER(11)');
        });
    }
}
