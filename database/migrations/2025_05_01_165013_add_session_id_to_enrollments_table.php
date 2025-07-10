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
        Schema::table('enrollment', function (Blueprint $table) {
            // Add session_id column that can be null (since it will be assigned upon acceptance)
            $table->foreignId('session_id')->nullable()->constrained('sessions')->after('formation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollment', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });
    }
};
