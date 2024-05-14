<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_carousels', function (Blueprint $table) {
            $table->bigIncrements('id');     
            $table->integer('eventtype_id')->unsigned()->index();                   
            $table->string('activity');
            $table->text('image_path')->nullable();
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
        Schema::dropIfExists('event_carousels');
    }
}
