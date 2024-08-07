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
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->integer('thematic_area_id')->unsigned()->nullable();
            $table->integer('indicator_id')->unsigned()->nullable();
            $table->integer('target_group_id')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('thematic_area_id')->references('id')->on('thematic_areas');
            $table->foreign('indicator_id')->references('id')->on('indicators');
            $table->foreign('target_group_id')->references('id')->on('target_groups');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
