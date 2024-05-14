<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trails', function (Blueprint $table) {
            $table->decimal('weekday_fee', 9, 2)->default(0);
            $table->decimal('weekend_fee', 9, 2)->default(0);
            $table->decimal('fee_per_guest', 9, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
