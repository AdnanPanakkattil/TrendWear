<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard_and_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_access_users_page(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login To Your Account');
    }

    public function test_user_can_login_using_email_via_ajax(): void
    {
        $user = User::factory()->create([
            'email' => 'adnan@trendwear.com',
            'username' => 'adnan_test',
            'password' => Hash::make('secret123'),
            'active' => 1,
            'is_delete' => 0,
            'role' => 'admin',
        ]);

        $response = $this->postJson('/login', [
            'email_or_username' => 'adnan@trendwear.com',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'redirect' => route('backend.dashboard'),
            ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_using_username_via_ajax(): void
    {
        $user = User::factory()->create([
            'email' => 'staff@trendwear.com',
            'username' => 'trendwear_staff',
            'password' => Hash::make('secret123'),
            'active' => 1,
            'is_delete' => 0,
            'role' => 'staff',
        ]);

        $response = $this->postJson('/login', [
            'email_or_username' => 'trendwear_staff',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'redirect' => route('backend.dashboard'),
            ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_user_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'inactive@trendwear.com',
            'username' => 'inactive_user',
            'password' => Hash::make('secret123'),
            'active' => 0,
            'is_delete' => 0,
        ]);

        $response = $this->postJson('/login', [
            'email_or_username' => 'inactive_user',
            'password' => 'secret123',
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'status' => 'error',
                'errors' => [
                    'error_msg' => ['Your account is deactivated. Please contact administrator.'],
                ],
            ]);

        $this->assertGuest();
    }

    public function test_deleted_user_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'deleted@trendwear.com',
            'username' => 'deleted_user',
            'password' => Hash::make('secret123'),
            'active' => 1,
            'is_delete' => 1,
        ]);

        $response = $this->postJson('/login', [
            'email_or_username' => 'deleted_user',
            'password' => 'secret123',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Invalid Credentials, Please try again.',
            ]);

        $this->assertGuest();
    }

    public function test_user_cannot_login_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'valid@trendwear.com',
            'username' => 'valid_user',
            'password' => Hash::make('secret123'),
            'active' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->postJson('/login', [
            'email_or_username' => 'valid@trendwear.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Invalid Credentials, Please try again.',
            ]);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'active' => 1,
            'is_delete' => 0,
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create([
            'active' => 1,
            'is_delete' => 0,
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
