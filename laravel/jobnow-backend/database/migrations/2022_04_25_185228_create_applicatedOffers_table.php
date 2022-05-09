<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicatedOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicated_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('curriculum');
            $table->unsignedBigInteger('offer_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('curriculum')->references('id')->on('files');
            $table->foreign('offer_id')->references('id')->on('offers');
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
        Schema::table('applicated_offers', function(Blueprint $table) {

            $table->dropForeign(['offer_id']);
            $table->dropForeign(['curriculum']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('applicated_offers');
    }
}
