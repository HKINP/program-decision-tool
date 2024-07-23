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
        Schema::create('priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('lgid')->unsigned()->nullable();
            $table->integer('target_group_id')->unsigned();
            $table->integer('thematic_area_id')->unsigned();
            $table->integer('question_id')->unsigned();            
            $table->text('response_all')->nullable();
            $table->text('response_underserved')->nullable();
            $table->integer('priority');
            $table->integer('updated_by')->unsigned();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('target_group_id')->references('id')->on('target_groups')->onDelete('cascade');
            $table->foreign('thematic_area_id')->references('id')->on('thematic_areas')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priorities');
    }
};
