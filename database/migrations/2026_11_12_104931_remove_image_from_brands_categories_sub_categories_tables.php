<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\ProductManagement\Models\Brand;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\SubCategory;

return new class extends Migration
{
    /**
     * Table-to-model mapping for migrating legacy image columns.
     *
     * @var array<string, class-string>
     */
    private array $tableModelMap = [
        'brands' => Brand::class,
        'categories' => Category::class,
        'sub_categories' => SubCategory::class,
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = now();

        foreach ($this->tableModelMap as $table => $modelClass) {
            if (! Schema::hasColumn($table, 'image')) {
                continue;
            }

            $rows = DB::table($table)
                ->whereNotNull('image')
                ->where('image', '!=', '')
                ->get(['id', 'image']);

            foreach ($rows as $row) {
                DB::table('media_files')->insert([
                    'mediable_type' => $modelClass,
                    'mediable_id' => $row->id,
                    'disk' => 'public',
                    'path' => $row->image,
                    'file_name' => basename($row->image),
                    'collection' => 'image',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            Schema::table($table, function (Blueprint $tableBlueprint) {
                $tableBlueprint->dropColumn('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tableModelMap as $table => $modelClass) {
            if (! Schema::hasColumn($table, 'image')) {
                Schema::table($table, function (Blueprint $tableBlueprint) {
                    $tableBlueprint->string('image', 255)->nullable()->after('name_ar');
                });
            }

            $mediaRows = DB::table('media_files')
                ->where('mediable_type', $modelClass)
                ->where('collection', 'image')
                ->get(['mediable_id', 'path']);

            foreach ($mediaRows as $mediaRow) {
                DB::table($table)
                    ->where('id', $mediaRow->mediable_id)
                    ->update(['image' => $mediaRow->path]);
            }
        }
    }
};
