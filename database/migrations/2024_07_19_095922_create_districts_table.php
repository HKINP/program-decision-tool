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
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->string('district');
            $table->integer('adolescent_girls')->nullable();
            $table->integer('children_under_5')->nullable();
            $table->integer('hospitals')->nullable();
            $table->integer('hps')->nullable(); // HPs
            $table->integer('otcs')->nullable(); // Of OTCs
            $table->integer('phccs')->nullable(); // PHCCs
            $table->integer('pregnant_women')->nullable();
            $table->integer('wra')->nullable(); // Women of Reproductive Age
            $table->integer('chus')->nullable(); // CHUs
            $table->integer('fchvs')->nullable(); // FCHVs
            $table->integer('uhcs')->nullable(); // UHCs
            $table->integer('akc')->nullable(); // AKC
            $table->integer('vhlc')->nullable(); // VHLC
            $table->integer('children_0_to_23_months')->nullable(); // Children 0 to 23 months
            $table->integer('epi_clinics')->nullable(); // EPI clinics
            $table->integer('hmg')->nullable(); // HMG
            $table->integer('low_equity_quintile_municipalities')->nullable(); // Low equity quintile municipalities
            $table->integer('birthing_centers')->nullable(); // Of birthing centers
            $table->integer('schools')->nullable(); // Of schools
            $table->integer('orc')->nullable(); // ORC            
            $table->integer('updated_by')->unsigned();
            $table->softDeletes(); 
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
