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
        if (Schema::hasColumn('videos', 'source')) {
            return;
        }

        Schema::table('videos', function (Blueprint $table) {
            $table->string('source')->default('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('videos', 'source')) {
            return;
        }

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
