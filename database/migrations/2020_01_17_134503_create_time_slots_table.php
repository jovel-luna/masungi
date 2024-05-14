<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trail_id')->unsigned()->index();
            $table->integer('trail_type_id')->unsigned()->index();
            $table->time('time');
            // $table->decimal('weekday_fee', 9, 2)->default(0);
            // $table->decimal('weekend_fee', 9, 2)->default(0);
            // $table->decimal('fee_per_guest', 9, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_slots');
    }
}
