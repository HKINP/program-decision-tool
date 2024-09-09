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
        Schema::create('federal_province_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('ir_id')->unsigned();
            $table->integer('outcomes_id')->unsigned();
            $table->integer('activity_id')->unsigned()->nullable();
            $table->text('proposed_activities');
            $table->json('months')->nullable(); // Store months as JSON
            $table->json('year')->nullable(); // Store year as JSON
            $table->string('total_target')->nullable(); // Store total target
            $table->text('implemented_by')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('outcomes_id')->references('id')->on('outcomes')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federal_province_activities');
    }
};
