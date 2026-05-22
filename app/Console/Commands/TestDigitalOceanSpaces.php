<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TestDigitalOceanSpaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spaces:test
                            {--disk=digital_ocean : Filesystem disk to validate}
                            {--minutes=10 : Lifetime of the presigned URL in minutes}
                            {--keep : Keep the uploaded probe object instead of deleting it}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validates DigitalOcean Spaces upload, existence, presigned URL access, and cleanup.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $diskName = (string) $this->option('disk');
        $minutes = max(1, (int) $this->option('minutes'));
        $config = config("filesystems.disks.{$diskName}");

        if (! is_array($config)) {
            $this->error("Filesystem disk [{$diskName}] is not configured.");

            return self::FAILURE;
        }

        foreach (['key', 'secret', 'bucket', 'endpoint', 'region'] as $requiredKey) {
            if (blank($config[$requiredKey] ?? null)) {
                $this->error("Filesystem disk [{$diskName}] is missing [{$requiredKey}] configuration.");

                return self::FAILURE;
            }
        }

        $disk = Storage::disk($diskName);
        $probePath = 'healthchecks/spaces-test-'.now()->format('Ymd-His').'-'.bin2hex(random_bytes(4)).'.txt';
        $probeBody = "DigitalOcean Spaces probe\nDisk: {$diskName}\nTimestamp: ".now()->toIso8601String()."\n";

        $this->info("Testing disk [{$diskName}]");
        $this->line('Bucket: '.$config['bucket']);
        $this->line('Endpoint: '.$config['endpoint']);
        $this->line('Client region: '.$config['region']);
        $this->line('Probe object: '.$probePath);

        try {
            $this->line('1. Uploading probe object...');
            $disk->put($probePath, $probeBody, ['visibility' => 'private']);

            $this->line('2. Verifying object existence...');
            if (! $disk->exists($probePath)) {
                $this->error('Probe object was uploaded but could not be found via the filesystem.');

                return $this->cleanupAndExit($disk, $probePath, self::FAILURE);
            }

            $this->line('3. Generating temporary URL...');
            $temporaryUrl = $disk->temporaryUrl($probePath, now()->addMinutes($minutes));
            $this->line($temporaryUrl);

            $this->line('4. Fetching the temporary URL...');
            $response = Http::timeout(30)->get($temporaryUrl);

            if (! $response->successful()) {
                $this->error('Temporary URL request failed with HTTP '.$response->status().'.');

                return $this->cleanupAndExit($disk, $probePath, self::FAILURE);
            }

            if ($response->body() !== $probeBody) {
                $this->error('Temporary URL returned unexpected content.');

                return $this->cleanupAndExit($disk, $probePath, self::FAILURE);
            }

            $this->info('5. Probe fetch succeeded and content matched.');

            if ($this->option('keep')) {
                $this->warn('Probe object kept because --keep was supplied.');

                return self::SUCCESS;
            }

            $this->line('6. Cleaning up probe object...');
            $disk->delete($probePath);

            if ($disk->exists($probePath)) {
                $this->error('Probe object still exists after delete.');

                return self::FAILURE;
            }

            $this->info('DigitalOcean Spaces validation passed.');

            return self::SUCCESS;
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return $this->cleanupAndExit($disk, $probePath, self::FAILURE);
        }
    }

    private function cleanupAndExit($disk, string $probePath, int $exitCode): int
    {
        if (! $this->option('keep')) {
            try {
                $disk->delete($probePath);
            } catch (Throwable) {
                // Best-effort cleanup only.
            }
        }

        return $exitCode;
    }
}
