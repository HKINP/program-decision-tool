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
        Schema::create('question_stage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('stage_id')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_stage');
    }
};
