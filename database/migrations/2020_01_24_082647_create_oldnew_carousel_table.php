<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldnewCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oldnew_carousel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('old_image_path')->nullable();
            $table->text('new_image_path')->nullable();            
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
        Schema::dropIfExists('oldnew_carousel');
    }
}
