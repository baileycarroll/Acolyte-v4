<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\SetupKeys;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthAndAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_log_in_with_username_and_password(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $user = $this->createUser([
            'username' => 'support-user',
            'password' => bcrypt('secret-pass'),
        ]);

        $response = $this->post('/login', [
            'username' => 'support-user',
            'password' => 'secret-pass',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_is_rate_limited_after_too_many_failed_attempts(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->createUser([
            'username' => 'rate-limited-user',
            'password' => bcrypt('secret-pass'),
        ]);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/login', [
                'username' => 'rate-limited-user',
                'password' => 'wrong-pass',
            ])->assertSessionHasErrors('username');
        }

        $this->post('/login', [
            'username' => 'rate-limited-user',
            'password' => 'wrong-pass',
        ])->assertStatus(429);
    }

    public function test_sanctum_route_returns_authenticated_user(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/user');

        $response->assertOk();
        $response->assertJsonPath('id', $user->id);
        $response->assertJsonPath('username', $user->username);
    }

    public function test_support_role_can_access_support_only_route(): void
    {
        $user = $this->createUser();

        Role::create(['name' => 'Support', 'guard_name' => 'web']);
        $user->assignRole('Support');

        $response = $this->actingAs($user)->get('/permissions');

        $response->assertOk();
    }

    public function test_non_support_user_is_forbidden_from_support_only_route(): void
    {
        $user = $this->createUser();
        Role::create(['name' => 'Support', 'guard_name' => 'web']);

        $response = $this->actingAs($user)->get('/permissions');

        $response->assertForbidden();
    }

    public function test_guest_is_redirected_to_login_from_protected_routes(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    public function test_demo_mode_blocks_billing_routes(): void
    {
        config([
            'demo.enabled' => true,
            'demo.features.billing' => false,
        ]);

        $user = $this->createUser();

        $response = $this->actingAs($user)->get('/membership');

        $response->assertForbidden();
    }

    private function createUser(array $attributes = []): User
    {
        $department = Department::query()->create(['name' => 'Support']);
        $learningStyle = Learning_Styles::query()->forceCreate(['name' => 'Visual']);
        $license = Licenses::query()->create([
            'name' => 'Demo License',
            'description' => 'Testing license',
            'stripe_api_id' => 'price_demo',
            'price' => 0,
            'trial' => 0,
            'admin' => 0,
        ]);

        SetupKeys::query()->forceCreate([
            'key' => 'instance_name',
            'value' => 'Acolyte Demo',
            'old_value' => null,
        ]);

        SetupKeys::query()->forceCreate([
            'key' => 'use_subscriptions',
            'value' => '0',
            'old_value' => null,
        ]);

        return User::factory()->create(array_merge([
            'primary_department' => $department->id,
            'secondary_department' => null,
            'learning_style' => $learningStyle->id,
            'license' => $license->id,
        ], $attributes));
    }
}
