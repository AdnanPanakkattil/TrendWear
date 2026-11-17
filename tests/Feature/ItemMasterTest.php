<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\ColorManagement;
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
        ]);

        $response = $this->postJson('/item_master/update/'.$item->id, [
            'sku' => 'SKU-NEW',
            'itemName_en' => 'Updated Title',
            'itemMinRetailPrice' => 45.00,
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

    public function test_item_code_increments_sequentially(): void
    {
        $response1 = $this->postJson('/item_master/store', [
            'itemName_en' => 'First Product',
        ]);
        $response1->assertCreated();
        $this->assertDatabaseHas('item_masters', [
            'name_en' => 'First Product',
            'item_code' => '1',
        ]);

        $response2 = $this->postJson('/item_master/store', [
            'itemName_en' => 'Second Product',
        ]);
        $response2->assertCreated();
        $this->assertDatabaseHas('item_masters', [
            'name_en' => 'Second Product',
            'item_code' => '2',
        ]);

        $this->assertEquals('3', ItemMaster::generateNextItemCode());
    }

    public function test_item_master_can_store_multiple_colors(): void
    {
        $colorRed = ColorManagement::create([
            'name_en' => 'Red',
            'name_ar' => 'أحمر',
            'color_code' => '#ff0000',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $colorBlue = ColorManagement::create([
            'name_en' => 'Blue',
            'name_ar' => 'أزرق',
            'color_code' => '#0000ff',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->postJson('/item_master/store', [
            'itemName_en' => 'T-Shirt with colors',
            'colors' => [$colorRed->id, $colorBlue->id],
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $item = ItemMaster::where('name_en', 'T-Shirt with colors')->firstOrFail();
        $this->assertEquals([$colorRed->id, $colorBlue->id], $item->colors);
        $this->assertCount(2, $item->color_models);
    }

    public function test_item_master_can_update_multiple_colors(): void
    {
        $colorRed = ColorManagement::create([
            'name_en' => 'Red',
            'name_ar' => 'أحمر',
            'color_code' => '#ff0000',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $colorBlack = ColorManagement::create([
            'name_en' => 'Black',
            'name_ar' => 'أسود',
            'color_code' => '#000000',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $item = ItemMaster::create([
            'name_en' => 'Item Initial Colors',
            'colors' => [$colorRed->id],
        ]);

        $response = $this->postJson('/item_master/update/'.$item->id, [
            'itemName_en' => 'Item Updated Colors',
            'colors' => [$colorRed->id, $colorBlack->id],
        ]);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $item->refresh();
        $this->assertEquals([$colorRed->id, $colorBlack->id], $item->colors);
    }

    public function test_create_and_edit_item_master_view_contains_colors(): void
    {
        $color = ColorManagement::create([
            'name_en' => 'Emerald Green',
            'name_ar' => 'أخضر زمردي',
            'color_code' => '#50c878',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $createResponse = $this->get('/add_item_master');
        $createResponse->assertOk();
        $createResponse->assertViewHas('colors');
        $createResponse->assertSee('Color Theme');
        $createResponse->assertSee('Emerald Green');

        $item = ItemMaster::create([
            'name_en' => 'Color Item Test',
            'colors' => [$color->id],
        ]);

        $editResponse = $this->get('/item_master/edit/'.$item->id);
        $editResponse->assertOk();
        $editResponse->assertViewHas('colors');
        $editResponse->assertSee('Emerald Green');
    }

    public function test_selling_price_cannot_be_less_than_cost_price_on_create(): void
    {
        $response = $this->postJson('/item_master/store', [
            'itemName_en' => 'Invalid Price Product',
            'cost_price' => 100.00,
            'selling_price' => 80.00,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['selling_price']);
    }

    public function test_selling_price_cannot_be_less_than_cost_price_on_update(): void
    {
        $item = ItemMaster::create([
            'name_en' => 'Existing Product',
            'cost_price' => 50.00,
            'selling_price' => 60.00,
        ]);

        $response = $this->postJson('/item_master/update/'.$item->id, [
            'itemName_en' => 'Existing Product Updated',
            'cost_price' => 100.00,
            'selling_price' => 90.00,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['selling_price']);
    }

    public function test_selling_price_equal_or_greater_than_cost_price_succeeds(): void
    {
        $response = $this->postJson('/item_master/store', [
            'itemName_en' => 'Valid Price Product',
            'cost_price' => 100.00,
            'selling_price' => 150.00,
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('item_masters', [
            'name_en' => 'Valid Price Product',
            'cost_price' => 100.00,
            'selling_price' => 150.00,
        ]);
    }
}
