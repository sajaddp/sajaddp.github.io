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
        if (Schema::hasColumn('videos', 'body') && Schema::hasColumn('videos', 'attachment_path')) {
            return;
        }

        Schema::table('videos', function (Blueprint $table) {
            if (! Schema::hasColumn('videos', 'body')) {
                $table->longText('body')->nullable();
            }

            if (! Schema::hasColumn('videos', 'attachment_path')) {
                $table->string('attachment_path')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            if (Schema::hasColumn('videos', 'body')) {
                $table->dropColumn('body');
            }

            if (Schema::hasColumn('videos', 'attachment_path')) {
                $table->dropColumn('attachment_path');
            }
        });
    }
};
