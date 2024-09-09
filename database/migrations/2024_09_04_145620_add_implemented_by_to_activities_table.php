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
        Schema::table('activities', function (Blueprint $table) {
            $table->text('implemented_by')->nullable();
            $table->text('activity_type')->nullable();
            $table->text('total_target')->nullable();
            $table->text('year')->nullable();
            $table->text('months')->nullable();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('activity_type');
            $table->dropColumn('implemented_by');
            $table->dropColumn('total_target');
            $table->dropColumn('year');
            $table->dropColumn('months');
        });
    }
};
