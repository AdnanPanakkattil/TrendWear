<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\ProductManagement\Models\Brand;
use Tests\TestCase;

class ProductBrandCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_brand_can_be_created(): void
    {
        $response = $this->postJson('/brands/store', [
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
        ]);

        $response->assertCreated()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('brands', [
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
            'is_delete' => 0,
        ]);
    }

    public function test_brand_requires_names(): void
    {
        $response = $this->postJson('/brands/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name_en', 'name_ar']);
    }

    public function test_brand_can_be_updated(): void
    {
        $brand = Brand::create([
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
        ]);

        $response = $this->postJson('/brands/update/'.$brand->id, [
            'name_en' => 'Adidas',
            'name_ar' => 'أديداس',
        ]);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name_en' => 'Adidas',
            'name_ar' => 'أديداس',
        ]);
    }

    public function test_brand_is_marked_deleted(): void
    {
        $brand = Brand::create([
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
        ]);

        $response = $this->postJson('/brands/delete/'.$brand->id);

        $response->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'is_delete' => 1,
        ]);
    }

    public function test_deleted_brand_is_excluded_from_the_list(): void
    {
        $deleted = Brand::create([
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
        ]);

        Brand::create([
            'name_en' => 'Adidas',
            'name_ar' => 'أديداس',
        ]);

        $deleted->update(['is_delete' => 1]);

        $response = $this->getJson('/brands/data');

        $response->assertOk()
            ->assertJsonFragment(['name_en' => 'Adidas'])
            ->assertJsonMissing(['name_en' => 'Nike']);
    }
}
