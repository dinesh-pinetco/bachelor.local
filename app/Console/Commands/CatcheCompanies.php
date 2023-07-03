<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class CatcheCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Catche companies data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Company::catchCollection();
    }
}
