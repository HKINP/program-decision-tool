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
        Schema::create('key_barriers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('stage_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->longText('key_barriers')->nullable();
            $table->integer('updated_by')->unsigned()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');             
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');        
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_barriers');
    }
};
