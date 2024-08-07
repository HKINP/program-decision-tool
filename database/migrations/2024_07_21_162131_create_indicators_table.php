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
        Schema::create('indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicator_name');          
            $table->integer('updated_by')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('updated_by')->references('id')->on('users');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};
