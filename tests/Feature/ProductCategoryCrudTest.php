<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\SubCategory;
use Tests\TestCase;

class ProductCategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_category_can_be_created(): void
    {
        $response = $this->postJson('/categories/store', [
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', [
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);
    }

    public function test_category_requires_names(): void
    {
        $response = $this->postJson('/categories/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name_en', 'name_ar']);
    }

    public function test_category_can_be_updated(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $response = $this->postJson('/categories/update/'.$category->id, [
            'name_en' => 'Women',
            'name_ar' => 'نساء',
        ]);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name_en' => 'Women',
            'name_ar' => 'نساء',
        ]);
    }

    public function test_category_is_soft_deleted(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $response = $this->postJson('/categories/delete/'.$category->id);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_sub_category_can_be_created(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $response = $this->postJson('/sub_categories/store', [
            'category_id' => $category->id,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('sub_categories', [
            'category_id' => $category->id,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);
    }

    public function test_sub_category_requires_an_existing_category(): void
    {
        $response = $this->postJson('/sub_categories/store', [
            'category_id' => 999,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['category_id']);
    }

    public function test_sub_category_can_be_updated(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);

        $response = $this->postJson('/sub_categories/update/'.$subCategory->id, [
            'category_id' => $category->id,
            'name_en' => 'Shirts',
            'name_ar' => 'قمصان',
        ]);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('sub_categories', [
            'id' => $subCategory->id,
            'name_en' => 'Shirts',
            'name_ar' => 'قمصان',
        ]);
    }

    public function test_sub_category_is_soft_deleted(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);

        $response = $this->postJson('/sub_categories/delete/'.$subCategory->id);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertSoftDeleted('sub_categories', ['id' => $subCategory->id]);
    }

    public function test_category_and_sub_category_data_endpoints_return_json(): void
    {
        $category = Category::create([
            'name_en' => 'Men',
            'name_ar' => 'رجال',
        ]);

        SubCategory::create([
            'category_id' => $category->id,
            'name_en' => 'T-Shirts',
            'name_ar' => 'تي شيرت',
        ]);

        $this->getJson('/categories/data')->assertOk();
        $this->getJson('/sub_categories/data')->assertOk();
    }
}
