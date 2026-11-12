<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserThemeColorTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_update_theme_color(): void
    {
        $response = $this->postJson(route('backend.theme-color.update'), [
            'theme_color' => '#6366f1',
        ]);

        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_update_theme_color(): void
    {
        $user = User::factory()->create([
            'theme_color' => '#ff5722',
        ]);

        $response = $this->actingAs($user)
            ->postJson(route('backend.theme-color.update'), [
                'theme_color' => '#0EA5E9',
            ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'theme_color' => '#0ea5e9',
                'palette' => [
                    'primary' => '#0ea5e9',
                    'primary_rgb' => '14, 165, 233',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'theme_color' => '#0ea5e9',
        ]);
    }

    public function test_invalid_theme_color_is_rejected(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson(route('backend.theme-color.update'), [
                'theme_color' => 'red; background: url(x)',
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['theme_color']);
    }

    public function test_each_user_renders_their_own_dashboard_color_theme(): void
    {
        $userOne = User::factory()->create(['theme_color' => '#10b981']);
        $userTwo = User::factory()->create(['theme_color' => '#8b5cf6']);

        $this->actingAs($userOne)
            ->get(route('backend.dashboard'))
            ->assertOk()
            ->assertSee('--tw-primary: #10b981;', false)
            ->assertSee('theme-color-customizer.js', false);

        $this->actingAs($userTwo)
            ->get(route('backend.dashboard'))
            ->assertOk()
            ->assertSee('--tw-primary: #8b5cf6;', false);
    }
}
