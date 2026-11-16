<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\ItemMaster;
use Modules\ProductManagement\Models\SubCategory;
use Tests\TestCase;

class ItemMasterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_item_master_can_be_created(): void
    {
        $category = Category::create([
            'name_en' => 'Clothing',
            'name_ar' => 'ملابس',
        ]);

        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name_en' => 'Shirts',
            'name_ar' => 'قمصان',
        ]);

        $response = $this->postJson('/item_master/store', [
            'sku' => 'SKU-001',
            'itemcodeId' => 'ITM-001',
            'itemName_en' => 'Casual Cotton Shirt',
            'itemName_ar' => 'قميص قطني كاجوال',
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'itemMinRetailPrice' => 49.99,
            'itemProfitLevel' => '20%',
            'itemMinimunQty' => 5,
            'itemReorderQty' => 10,
            'itemMaximunQty' => 100,
            'itemDescription' => 'High quality casual cotton shirt',
            'ecommerce_status' => 1,
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('item_masters', [
            'sku' => 'SKU-001',
            'item_code' => 'ITM-001',
            'name_en' => 'Casual Cotton Shirt',
            'name_ar' => 'قميص قطني كاجوال',
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'min_qty' => 5,
            'reorder_qty' => 10,
            'max_qty' => 100,
            'deleted_at' => null,
        ]);
    }

    public function test_item_master_requires_english_title(): void
    {
        $response = $this->postJson('/item_master/store', [
            'sku' => 'SKU-002',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['itemName_en']);
    }

    public function test_item_master_can_be_updated(): void
    {
        $item = ItemMaster::create([
            'sku' => 'SKU-OLD',
            'name_en' => 'Old Title',
            'min_retail_price' => 30.00,
            'ecommerce_status' => true,
        ]);

        $response = $this->postJson('/item_master/update/'.$item->id, [
            'sku' => 'SKU-NEW',
            'itemName_en' => 'Updated Title',
            'itemMinRetailPrice' => 45.00,
            'ecommerce_status' => 1,
        ]);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('item_masters', [
            'id' => $item->id,
            'sku' => 'SKU-NEW',
            'name_en' => 'Updated Title',
            'min_retail_price' => 45.00,
        ]);
    }

    public function test_item_master_can_be_soft_deleted(): void
    {
        $item = ItemMaster::create([
            'sku' => 'SKU-DEL',
            'name_en' => 'Item to Delete',
            'ecommerce_status' => true,
        ]);

        $response = $this->postJson('/item_master/delete/'.$item->id);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertSoftDeleted('item_masters', [
            'id' => $item->id,
        ]);
    }

    public function test_item_master_datatable_endpoint_returns_json(): void
    {
        ItemMaster::create([
            'sku' => 'SKU-TABLE',
            'name_en' => 'Table Item',
            'ecommerce_status' => true,
        ]);

        $response = $this->getJson('/item_master/data');

        $response->assertOk()
            ->assertJsonStructure([
                'draw',
                'recordsTotal',
                'recordsFiltered',
                'data',
            ]);
    }
}
