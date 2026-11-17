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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 50);
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->tinyInteger('status')->default(1); // 1 = Active, 0 = Inactive
            $table->decimal('chest_inch', 8, 2)->nullable();
            $table->decimal('waist_inch', 8, 2)->nullable();
            $table->decimal('shoulder_inch', 8, 2)->nullable();
            $table->decimal('length_inch', 8, 2)->nullable();
            $table->decimal('sleeve_length_inch', 8, 2)->nullable();
            $table->tinyInteger('is_delete')->default(0); // 0 = Not deleted, 1 = Deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
