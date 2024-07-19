<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->ipAddress('ip_address')->nullable()->default(null);
            $table->text('subject')->nullable()->default(null);
            $table->longText('email_content')->nullable()->default(null);
            $table->json('from_email')->nullable()->default(null);
            $table->json('to_email')->nullable()->default(null);
            $table->json('cc_email')->nullable()->default(null);
            $table->unsignedTinyInteger('type')->nullable()->default(null);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_logs');
    }
}
