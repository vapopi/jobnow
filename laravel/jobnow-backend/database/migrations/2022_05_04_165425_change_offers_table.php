<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function(Blueprint $table) {

            $table->unsignedBigInteger('professional_area_id');
            $table->foreign('professional_area_id')->references('id')->on('professional_areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function(Blueprint $table) {

            $table->dropForeign(['professional_area_id']);
            $table->dropColumn('professional_area_id');
        });
    }
}
