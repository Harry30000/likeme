<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hethonglike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->unique();
            $table->string('name')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('locale', 5)->nullable();
            $table->boolean('verified')->nullable();
            $table->string('app_id')->nullable();
            $table->string('access_token')->unique();
            $table->timestamps();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('like_limit');
            $table->integer('comment_limit');
            $table->integer('like');
            $table->integer('comment');
            $table->string('description')->nullable();
        });

        Schema::create('vip_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('prices_id')->unsigned();
            $table->integer('like_available');
            $table->integer('comment_available');
            $table->date('begin');
            $table->date('end');
            $table->timestamps();
        });

        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('object_id');
            $table->integer('botlike')->default(0);
            $table->integer('like')->default(0);
            $table->integer('comment')->default(0);
            $table->timestamps();
        });

        Schema::create('botlikes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('facebook_id')->unique();
            $table->string('name');
            $table->integer('like');
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
        Schema::drop('tokens');
        Schema::drop('prices');
        Schema::drop('vip_users');
        Schema::drop('logs');
        Schema::drop('botlikes');
    }
}
