<?php

namespace App\Console\Commands;

use App\Http\Controllers\PermissionsController;
use Illuminate\Console\Command;

class UpdateSupportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateSupportUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the Support User with all Permissions in the System by Syncing the Support Role.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        PermissionsController::updateSupportUser();
    }
}
