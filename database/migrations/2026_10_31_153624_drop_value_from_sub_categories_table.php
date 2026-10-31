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
        if (Schema::hasColumn('sub_categories', 'value')) {
            Schema::table('sub_categories', function (Blueprint $table) {
                $table->dropColumn('value');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('sub_categories', 'value')) {
            Schema::table('sub_categories', function (Blueprint $table) {
                $table->string('value', 120)->nullable()->after('name_ar');
            });
        }
    }
};
