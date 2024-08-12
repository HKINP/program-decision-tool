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
            $table->Integer('province_id')->unsigned();
            $table->Integer('district_id')->unsigned();
            $table->Integer('stage_id')->unsigned();
            $table->Integer('target_group_id')->unsigned();
            $table->Integer('thematic_area_id')->unsigned();
            $table->Integer('indicator_id')->unsigned();
            $table->Integer('platforms_id')->unsigned();
            $table->text('proposed_activities');
            $table->string('targeted_for');
            $table->text('remarks')->nullable();            
            $table->integer('updated_by')->unsigned()->default(null);
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('target_group_id')->references('id')->on('target_groups')->onDelete('cascade');
            $table->foreign('thematic_area_id')->references('id')->on('thematic_areas')->onDelete('cascade');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
            $table->foreign('platforms_id')->references('id')->on('platforms')->onDelete('cascade');
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
