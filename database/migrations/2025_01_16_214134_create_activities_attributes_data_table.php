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
        Schema::create('activities_attributes_data', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->string('event_date');
            $table->string('event_location');
            $table->integer('activity_id')->unsigned();
            $table->json('attributes_data')->nullable();
            $table->integer('updated_by')->unsigned()->default(null);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_attributes_data');
    }
};
