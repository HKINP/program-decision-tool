<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('original_user_id')->nullable()->default(null);
            $table->string('model')->nullable()->default(null);
            $table->integer('model_id')->unsigned()->nullable()->default(null);
            $table->string('action')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->json('before_details')->nullable()->default(null);
            $table->json('after_details')->nullable()->default(null);
            $table->ipAddress('ip_address')->nullable()->default(null);
            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
