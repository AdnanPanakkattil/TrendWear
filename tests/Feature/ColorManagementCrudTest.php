<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\ProductManagement\Models\ColorManagement;
use Tests\TestCase;

class ColorManagementCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_color_management_page_can_be_rendered(): void
    {
        $response = $this->get(route('productmanagement.colors'));

        $response->assertOk()
            ->assertSee('Color Management')
            ->assertSee('Add Color');
    }

    public function test_color_management_datatable_ajax_returns_data(): void
    {
        ColorManagement::create([
            'name_en' => 'Emerald Green',
            'name_ar' => 'أخضر زمردي',
            'color_code' => '#50c878',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->getJson(route('productmanagement.colors'), [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_color_can_be_created(): void
    {
        $response = $this->postJson(route('productmanagement.colors.store'), [
            'name_en' => 'Royal Blue',
            'name_ar' => 'أزرق ملكي',
            'color_code' => '#4169e1',
            'status' => '1',
        ]);

        $response->assertCreated()
            ->assertJson([
                'success' => true,
                'message' => 'Color created successfully.',
            ]);

        $this->assertDatabaseHas('color_management', [
            'name_en' => 'Royal Blue',
            'name_ar' => 'أزرق ملكي',
            'color_code' => '#4169e1',
            'status' => 1,
            'is_delete' => 0,
        ]);
    }

    public function test_color_requires_required_fields(): void
    {
        $response = $this->postJson(route('productmanagement.colors.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name_en', 'name_ar', 'color_code']);
    }

    public function test_color_validates_hex_code_format(): void
    {
        $response = $this->postJson(route('productmanagement.colors.store'), [
            'name_en' => 'Red',
            'name_ar' => 'أحمر',
            'color_code' => 'invalid-color',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['color_code']);
    }

    public function test_color_can_be_fetched_for_editing(): void
    {
        $color = ColorManagement::create([
            'name_en' => 'Crimson Red',
            'name_ar' => 'أحمر قرمزي',
            'color_code' => '#dc143c',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->getJson(route('productmanagement.colors.edit', $color->id));

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $color->id,
                    'name_en' => 'Crimson Red',
                    'name_ar' => 'أحمر قرمزي',
                    'color_code' => '#dc143c',
                    'status' => 1,
                ],
            ]);
    }

    public function test_color_can_be_updated(): void
    {
        $color = ColorManagement::create([
            'name_en' => 'Dark Blue',
            'name_ar' => 'أزرق غامق',
            'color_code' => '#00008b',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->postJson(route('productmanagement.colors.store'), [
            'id' => $color->id,
            'name_en' => 'Midnight Blue',
            'name_ar' => 'أزرق ليلي',
            'color_code' => '#191970',
            'status' => '0',
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Color updated successfully.',
            ]);

        $this->assertDatabaseHas('color_management', [
            'id' => $color->id,
            'name_en' => 'Midnight Blue',
            'name_ar' => 'أزرق ليلي',
            'color_code' => '#191970',
            'status' => 0,
        ]);
    }

    public function test_color_can_be_deleted(): void
    {
        $color = ColorManagement::create([
            'name_en' => 'Coral',
            'name_ar' => 'مرجاني',
            'color_code' => '#ff7f50',
            'status' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->postJson(route('productmanagement.colors.destroy', $color->id));

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Color deleted successfully.',
            ]);

        $this->assertDatabaseHas('color_management', [
            'id' => $color->id,
            'is_delete' => 1,
        ]);
    }
}
