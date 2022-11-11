<?php

namespace App\Console\Commands;

use App\Jobs\SyncApplicantsToHubspotJob;
use Illuminate\Console\Command;

class SyncApplicantsToHubspotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applicant:hubspot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync applicant data to hubspot.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SyncApplicantsToHubspotJob::dispatch();
    }
}
