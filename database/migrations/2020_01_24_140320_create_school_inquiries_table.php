<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_inquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school');
            $table->string('leadcontact');
            $table->string('position');
            $table->string('email');            
            $table->string('contact_number');
            $table->string('yearlevel');
            $table->string('preferreddate');
            $table->string('preferredtime');                                    
            $table->integer('experience');
            $table->string('message')->nullable();
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
        Schema::dropIfExists('school_inquiries');
    }
}
