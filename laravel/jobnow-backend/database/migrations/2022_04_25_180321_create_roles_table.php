<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name", 20)->unique();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->string("surnames", 50);
            $table->string("phone", 20)->unique();
            $table->timestamp("birth_date");
            $table->boolean("terms")->default(false);
            $table->boolean("premium")->default(false);
            $table->unsignedBigInteger("avatar_id");
            $table->unsignedBigInteger("role_id");
            $table->foreign("avatar_id")->references("id")->on("files");
            $table->foreign("role_id")->references("id")->on("roles");
        });

        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['avatar_id']);
            $table->dropColumn(['role_id', 'avatar_id', 'premium', 'terms', 'birth_date', 'phone', 'surnames']);
        });

        Schema::dropIfExists('roles');
    }
}