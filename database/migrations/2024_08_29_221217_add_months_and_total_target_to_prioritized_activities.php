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
        Schema::table('prioritized_activities', function (Blueprint $table) {
            $table->json('months')->nullable(); // To store months as JSON
            $table->json('year')->nullable(); // To store months as JSON
            $table->string('total_target')->nullable(); // To store total target
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prioritized_activities', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('months');
            $table->dropColumn('total_target');
        });
    }
};
