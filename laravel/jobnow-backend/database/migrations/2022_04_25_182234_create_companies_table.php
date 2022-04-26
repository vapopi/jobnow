<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->string("password");
            $table->timestamp("creation_date")->nullable();
            $table->string("email", 50)->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->unsignedBigInteger("logo_id");
            $table->unsignedBigInteger("role_id");
            $table->foreign("logo_id")->references("id")->on("files");
            $table->foreign("role_id")->references("id")->on("roles");
            $table->rememberToken();
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
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['logo_id']);
        });
        
        Schema::dropIfExists('companies');
    }
}
