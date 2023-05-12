<?php

namespace App\Jobs;

use App\Services\Companies\Companies;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchSannaCompaniesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $totalItems = Companies::make()->setItemsPerPage(1)->getTotalItems();

        $totalPages = ceil($totalItems / 100);

        for ($i = 1; $i <= $totalPages; $i++) {
            SyncCompaniesJob::dispatch($i, 100);
        }
    }
}
