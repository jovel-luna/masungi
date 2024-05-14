<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_id')->unsigned()->index();
            $table->string('name');
            $table->longText('activity');                        
            $table->string('duration');
            $table->string('age_group');            
            $table->longText('participants');
            $table->longText('conservation_fees');
            $table->longText('conservation_info');
            $table->longText('features');
            $table->longText('description')->nullable();                        
            $table->boolean('status')->default(true);            
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
        Schema::dropIfExists('event_types');
    }
}
