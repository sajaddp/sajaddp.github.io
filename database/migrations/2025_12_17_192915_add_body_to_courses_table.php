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
        if (Schema::hasColumn('courses', 'body')) {
            return;
        }

        Schema::table('courses', function (Blueprint $table) {
            $table->longText('body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('courses', 'body')) {
            return;
        }

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('body');
        });
    }
};
