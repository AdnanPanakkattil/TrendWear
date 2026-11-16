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
        Schema::create('item_masters', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable()->index();
            $table->string('item_code')->nullable()->index();
            $table->string('item_ref_code')->nullable();
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->decimal('min_retail_price', 12, 2)->nullable();
            $table->string('profit_level')->nullable();
            $table->integer('min_qty')->nullable();
            $table->integer('reorder_qty')->nullable();
            $table->integer('max_qty')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('note')->nullable();
            $table->string('tests')->nullable();
            $table->string('sample')->nullable();
            $table->string('results')->nullable();
            $table->boolean('ecommerce_status')->default(true);
            $table->boolean('offer_product_status')->default(false);
            $table->boolean('best_selling_status')->default(false);
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_masters');
    }
};
