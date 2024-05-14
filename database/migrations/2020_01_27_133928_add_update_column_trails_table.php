<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateColumnTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trails', function (Blueprint $table) {
            $table->string('terrain')->nullable();
            $table->integer('age_group')->default(1);
            $table->text('overview')->nullable();
            $table->text('characteristic')->nullable();
            $table->text('ideal_for')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('good_to_know')->nullable();
            $table->text('visit_request_process')->nullable();
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
