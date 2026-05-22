<?php

namespace Tests\Feature;

use App\Console\Commands\ResetDemoEnvironment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DemoResetCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_reset_refuses_to_run_against_a_protected_disk(): void
    {
        config([
            'demo.enabled' => true,
            'demo.reset.enabled' => true,
            'demo.reset.disk' => 'local',
        ]);

        $this->artisan('demo:reset')
            ->expectsOutput('Demo reset refused: [local] is not a dedicated demo disk.')
            ->assertExitCode(1);
    }

    public function test_demo_reset_refuses_to_wipe_stripe_customers_with_a_non_test_key(): void
    {
        config([
            'demo.enabled' => true,
            'demo.reset.enabled' => true,
            'demo.reset.disk' => 'demo_test',
            'demo.reset.wipe_stripe_customers' => true,
            'demo.reset.allow_live_stripe_keys' => false,
            'services.stripe.secret' => 'sk_live_demo',
            'filesystems.disks.demo_test' => [
                'driver' => 'local',
                'root' => storage_path('framework/testing/demo-test-disk'),
                'throw' => false,
            ],
        ]);

        $this->artisan('demo:reset')
            ->expectsOutput('Demo reset refused: Stripe wipe requires a test key unless live keys are explicitly allowed.')
            ->assertExitCode(1);
    }

    public function test_demo_reset_clears_demo_storage_and_invokes_the_demo_seeder(): void
    {
        config([
            'demo.enabled' => true,
            'demo.reset.enabled' => true,
            'demo.reset.disk' => 'demo_test',
            'demo.reset.seeder' => \Database\Seeders\DemoSeeder::class,
            'demo.reset.wipe_stripe_customers' => true,
            'filesystems.default' => 'demo_test',
            'filesystems.disks.demo_test' => [
                'driver' => 'local',
                'root' => storage_path('framework/testing/demo-test-disk'),
                'throw' => false,
            ],
        ]);

        Storage::disk('demo_test')->put('orphaned/demo.txt', 'stale');

        $command = new class extends ResetDemoEnvironment
        {
            public array $recordedCalls = [];
            public bool $stripeWipeCalled = false;

            public function __construct()
            {
                parent::__construct();
            }

            public function call($command, array $arguments = []): int
            {
                $this->recordedCalls[] = [$command, $arguments];

                return self::SUCCESS;
            }

            protected function wipeStripeCustomersIfConfigured(): bool
            {
                $this->stripeWipeCalled = true;

                return true;
            }
        };

        $this->app->instance(ResetDemoEnvironment::class, $command);

        $this->artisan('demo:reset')->assertExitCode(0);

        $this->assertFalse(Storage::disk('demo_test')->exists('orphaned/demo.txt'));
        $this->assertTrue($command->stripeWipeCalled);
        $this->assertSame('migrate:fresh', $command->recordedCalls[0][0]);
        $this->assertTrue($command->recordedCalls[0][1]['--seed']);
        $this->assertSame(\Database\Seeders\DemoSeeder::class, $command->recordedCalls[0][1]['--seeder']);
        $this->assertTrue($command->recordedCalls[0][1]['--force']);
        $this->assertSame(0, User::count());
    }
}
