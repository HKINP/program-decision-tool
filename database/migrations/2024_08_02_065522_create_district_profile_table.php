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
        Schema::create('district_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->string('all_value');
            $table->string('source');          
            $table->integer('updated_by')->unsigned();
            $table->boolean('displayinreport')->default(0);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('indicator_id')->references('id')->on('indicators');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_profile');
    }
};
