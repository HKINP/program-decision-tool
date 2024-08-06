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
        Schema::create('thematic_area_target_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thematic_area_id')->constrained('thematic_areas')->onDelete('cascade');
            $table->integer('target_group_id')->constrained('target_groups')->onDelete('cascade'); 
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thematic_area_target_group');
    }
};
