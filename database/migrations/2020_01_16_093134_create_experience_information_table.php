<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('experience_id')->unsigned()->index();
            $table->longText('duration');
            $table->longText('terrain');
            $table->longText('age_group');
            $table->longText('conservation_fees');
            $table->longText('overview')->nullable();
            $table->longText('trail_characteristics');
            $table->longText('ideal_for');
            $table->longText('inclusions')->nullable();
            $table->longText('good_to_know');
            $table->longText('conservation_fee_detail');
            $table->longText('visit_request');

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
        Schema::dropIfExists('experience_information');
    }
}
