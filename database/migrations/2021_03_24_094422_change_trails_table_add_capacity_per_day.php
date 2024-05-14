<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTrailsTableAddCapacityPerDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trails', function (Blueprint $table) {
            $table->integer('capacity_per_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trails', function (Blueprint $table) {
            $table->dropColumn('capacity_per_day');
        });
    }
}
