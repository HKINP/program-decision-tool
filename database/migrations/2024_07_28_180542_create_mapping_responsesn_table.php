<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mapping_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stage_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('lgid')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->text('response_all')->nullable();
            $table->text('response_underserved')->nullable();
            $table->integer('updated_by')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_responses');
    }
};
