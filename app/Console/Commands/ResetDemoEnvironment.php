<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Cashier;

class ResetDemoEnvironment extends Command
{
    protected $signature = 'demo:reset';

    protected $description = 'Clears the dedicated demo storage disk and rebuilds the database with the demo seeders.';

    public function handle(): int
    {
        if (! config('demo.enabled')) {
            $this->error('Demo reset refused: demo mode is disabled.');

            return self::FAILURE;
        }

        if (! config('demo.reset.enabled')) {
            $this->error('Demo reset refused: hourly demo reset is disabled.');

            return self::FAILURE;
        }

        $diskName = (string) config('demo.reset.disk');

        if ($diskName === '') {
            $this->error('Demo reset refused: no demo reset disk is configured.');

            return self::FAILURE;
        }

        if (in_array($diskName, config('demo.reset.protected_disks', []), true)) {
            $this->error("Demo reset refused: [{$diskName}] is not a dedicated demo disk.");

            return self::FAILURE;
        }

        $configuredDisks = array_keys(config('filesystems.disks', []));

        if (! in_array($diskName, $configuredDisks, true)) {
            $this->error("Demo reset refused: filesystem disk [{$diskName}] is not defined.");

            return self::FAILURE;
        }

        if (! $this->wipeStripeCustomersIfConfigured()) {
            return self::FAILURE;
        }

        $this->info("Clearing demo storage disk [{$diskName}]...");
        $this->clearDiskContents($diskName);

        $seederClass = (string) config('demo.reset.seeder');
        $this->info("Rebuilding demo database with [{$seederClass}]...");

        $result = $this->call('migrate:fresh', [
            '--seed' => true,
            '--seeder' => $seederClass,
            '--force' => true,
        ]);

        if ($result !== self::SUCCESS) {
            $this->error('Database rebuild failed during demo reset.');

            return $result;
        }

        $this->info('Demo environment reset complete.');

        return self::SUCCESS;
    }

    protected function wipeStripeCustomersIfConfigured(): bool
    {
        if (! config('demo.reset.wipe_stripe_customers')) {
            return true;
        }

        $stripeSecret = (string) config('services.stripe.secret');

        if ($stripeSecret === '') {
            $this->error('Demo reset refused: Stripe customer wipe is enabled but no Stripe secret is configured.');

            return false;
        }

        if (! config('demo.reset.allow_live_stripe_keys') && ! str_starts_with($stripeSecret, 'sk_test_')) {
            $this->error('Demo reset refused: Stripe wipe requires a test key unless live keys are explicitly allowed.');

            return false;
        }

        $this->info('Deleting Stripe customers from the dedicated demo sandbox...');

        $customersService = Cashier::stripe()->customers;
        $customerCount = 0;

        foreach ($customersService->all(['limit' => 100])->autoPagingIterator() as $customer) {
            $customersService->delete($customer->id, []);
            $customerCount++;
        }

        $this->info("Deleted {$customerCount} Stripe customer(s).");

        return true;
    }

    private function clearDiskContents(string $diskName): void
    {
        $disk = Storage::disk($diskName);
        $files = $disk->allFiles();

        if ($files !== []) {
            foreach (array_chunk($files, 500) as $chunk) {
                $disk->delete($chunk);
            }
        }

        $directories = $disk->allDirectories();
        rsort($directories);

        foreach ($directories as $directory) {
            $disk->deleteDirectory($directory);
        }
    }
}
