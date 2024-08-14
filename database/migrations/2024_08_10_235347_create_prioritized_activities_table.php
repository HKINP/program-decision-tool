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
        Schema::create('prioritized_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('stage_id')->unsigned();
            $table->integer('target_group_id')->unsigned()->nullable();
            $table->integer('thematic_area_id')->unsigned()->nullable();
            $table->integer('indicator_id')->unsigned()->nullable();
            $table->text('platforms_id'); // Changed to text for comma-separated values
            $table->integer('activity_id')->unsigned()->nullable();
            $table->text('proposed_activities');
            $table->string('targeted_for');
            $table->text('remarks')->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('target_group_id')->references('id')->on('target_groups')->onDelete('cascade');
            $table->foreign('thematic_area_id')->references('id')->on('thematic_areas')->onDelete('cascade');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prioritized_activities');
    }
};
