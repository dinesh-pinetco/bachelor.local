<?php

namespace App\Console\Commands;

use App\Services\Companies\Companies;
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
        Companies::make()->sync();

        return Command::SUCCESS;
    }
}
