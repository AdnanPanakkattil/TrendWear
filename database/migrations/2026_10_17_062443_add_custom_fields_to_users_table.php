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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_en', 100)->nullable();
            $table->string('name_ar', 100)->nullable();

            $table->string('username', 100)->nullable()->unique();
            $table->string('mobile_no', 20)->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->enum('role',['super_admin','admin','staff','inventory_manager','customer'])->default('customer');
            $table->date('joined_date')->nullable();
            $table->boolean('active')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn([
                  'name_en',
                'name_ar',
                'username',
                'mobile_no',
                'gender',
                'role',
                'joined_date',
                'active',
            ]);
        });
    }
};
