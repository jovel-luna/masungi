<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedDateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_date_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trail_id')->unsigned()->index();
            $table->string('reason');
            $table->string('description')->nullable();
            $table->date('date');
            $table->boolean('is_whole_day')->default(false);
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
        Schema::dropIfExists('blocked_date_times');
    }
}
