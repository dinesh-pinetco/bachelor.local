<?php

namespace App\Console\Commands;

use App\Jobs\FetchSannaCompaniesJob;
use Illuminate\Console\Command;

class SyncCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync all companies and its contacts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        FetchSannaCompaniesJob::dispatch();

        return Command::SUCCESS;
    }
}
