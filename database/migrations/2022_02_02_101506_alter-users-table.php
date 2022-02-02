<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name')->nullable()->unique()->after('name');
            $table->string('phone')->nullable()->unique()->after('user_name');
            $table->enum('type',['user' ,'admin','super_admin'])->default('user')->after('profile_photo_path');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->drop('user_name');
            $table->drop('phone');
            $table->drop('type');
            $table->drop('phone');


        });
    }
}
