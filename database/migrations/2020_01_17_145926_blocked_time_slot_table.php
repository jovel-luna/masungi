<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlockedTimeSlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_time_slot', function (Blueprint $table) {
            $table->integer('blocked_date_time_id')->unsigned()->index();
            // $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->integer('time_slot_id')->unsigned()->index();
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->primary(['blocked_date_time_id', 'time_slot_id']);
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
