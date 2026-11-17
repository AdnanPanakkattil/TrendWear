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
        Schema::table('item_masters', function (Blueprint $table) {
            $table->decimal('cost_price', 12, 2)->nullable()->after('min_retail_price');
            $table->decimal('selling_price', 12, 2)->nullable()->after('cost_price');
            $table->decimal('offer_price', 12, 2)->nullable()->after('selling_price');
            $table->boolean('featured_product')->default(false)->after('best_selling_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_masters', function (Blueprint $table) {
            $table->dropColumn(['cost_price', 'selling_price', 'offer_price', 'featured_product']);
        });
    }
};
