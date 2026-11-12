<?php

namespace Tests\Feature;

use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\ProductManagement\Models\Brand;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\SubCategory;
use Tests\TestCase;

class MediaFileStorageTest extends TestCase
{
    use RefreshDatabase;

    public function test_brands_categories_and_sub_categories_do_not_have_image_column(): void
    {
        $this->assertFalse(Schema::hasColumn('brands', 'image'));
        $this->assertFalse(Schema::hasColumn('categories', 'image'));
        $this->assertFalse(Schema::hasColumn('sub_categories', 'image'));
        $this->assertTrue(Schema::hasTable('media_files'));
    }

    public function test_brand_stores_updates_and_retrieves_image_from_media_files(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $firstFile = UploadedFile::fake()->image('brand-one.png');

        $storeResponse = $this->actingAs($user)->postJson(route('productmanagement.brands.store'), [
            'name_en' => 'Nike',
            'name_ar' => 'نايك',
            'image' => $firstFile,
        ]);

        $storeResponse->assertCreated()->assertJson(['success' => true]);

        $brand = Brand::firstOrFail();
        $firstMedia = MediaFile::where('mediable_type', Brand::class)
            ->where('mediable_id', $brand->id)
            ->first();

        $this->assertNotNull($firstMedia);
        Storage::disk('public')->assertExists($firstMedia->path);

        $editResponse = $this->actingAs($user)->getJson(route('productmanagement.brands.edit', $brand->id));
        $editResponse->assertOk()
            ->assertJsonPath('data.image', $firstMedia->path)
            ->assertJsonPath('data.image_url', Storage::disk('public')->url($firstMedia->path));

        $secondFile = UploadedFile::fake()->image('brand-two.png');

        $updateResponse = $this->actingAs($user)->postJson(route('productmanagement.brands.update', $brand->id), [
            'name_en' => 'Nike Updated',
            'name_ar' => 'نايك',
            'image' => $secondFile,
        ]);

        $updateResponse->assertOk()->assertJson(['success' => true]);

        Storage::disk('public')->assertMissing($firstMedia->path);
        $this->assertDatabaseMissing('media_files', ['id' => $firstMedia->id]);

        $updatedMedia = $brand->fresh()->mediaFile;
        $this->assertNotNull($updatedMedia);
        Storage::disk('public')->assertExists($updatedMedia->path);
    }

    public function test_category_and_sub_category_store_and_retrieve_images_from_media_files(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $categoryFile = UploadedFile::fake()->image('category.jpg');

        $categoryResponse = $this->actingAs($user)->postJson(route('productmanagement.categories.store'), [
            'name_en' => 'Shoes',
            'name_ar' => 'أحذية',
            'image' => $categoryFile,
        ]);

        $categoryResponse->assertCreated()->assertJson(['success' => true]);

        $category = Category::firstOrFail();
        $categoryMedia = $category->mediaFile;

        $this->assertNotNull($categoryMedia);
        Storage::disk('public')->assertExists($categoryMedia->path);

        $this->actingAs($user)
            ->getJson(route('productmanagement.categories.edit', $category->id))
            ->assertOk()
            ->assertJsonPath('data.image', $categoryMedia->path)
            ->assertJsonPath('data.image_url', Storage::disk('public')->url($categoryMedia->path));

        $subCategoryFile = UploadedFile::fake()->image('sub-category.webp');

        $subCategoryResponse = $this->actingAs($user)->postJson(route('productmanagement.sub_categories.store'), [
            'category_id' => $category->id,
            'name_en' => 'Running',
            'name_ar' => 'جري',
            'image' => $subCategoryFile,
        ]);

        $subCategoryResponse->assertCreated()->assertJson(['success' => true]);

        $subCategory = SubCategory::firstOrFail();
        $subCategoryMedia = $subCategory->mediaFile;

        $this->assertNotNull($subCategoryMedia);
        Storage::disk('public')->assertExists($subCategoryMedia->path);

        $this->actingAs($user)
            ->getJson(route('productmanagement.sub_categories.edit', $subCategory->id))
            ->assertOk()
            ->assertJsonPath('data.image', $subCategoryMedia->path)
            ->assertJsonPath('data.image_url', Storage::disk('public')->url($subCategoryMedia->path));
    }
}
