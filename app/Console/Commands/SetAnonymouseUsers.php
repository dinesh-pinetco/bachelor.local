<?php

namespace App\Console\Commands;

use App\Jobs\SetAnonymousUsersJob;
use Illuminate\Console\Command;

class SetAnonymouseUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anonymous:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set anonymous users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SetAnonymousUsersJob::dispatch();
    }
}
