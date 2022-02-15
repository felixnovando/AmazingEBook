<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->nullable(false);;
            $table->foreignId("role_id")->references("role_id")->on("roles")->onDelete("cascade");
            $table->foreignId("gender_id")->references("gender_id")->on("genders")->onDelete("cascade");
            $table->string("first_name", 25)->nullable(false);
            $table->string("middle_name", 25)->nullable(true);
            $table->string("last_name", 25)->nullable(false);
            $table->string("email", 50)->nullable(false);
//            $table->string("password", 50)->nullable(false);
            $table->string("password")->nullable(false);
            $table->string("display_picture_link", 255)->nullable(false);
            $table->integer("delete_flag")->default(0);
            $table->date("modified_at");
            $table->string("modified_by", 255);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
