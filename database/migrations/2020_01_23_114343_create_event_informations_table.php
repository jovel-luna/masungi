<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('activity');            
            $table->longText('description')->nullable();
            $table->longText('features');
            $table->longText('conservation_fees');
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
        Schema::dropIfExists('event_informations');
    }
}
