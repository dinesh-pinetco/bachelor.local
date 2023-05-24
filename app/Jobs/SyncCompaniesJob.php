<?php

namespace App\Jobs;

use App\Services\Companies\Companies;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncCompaniesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $page;

    public $items;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page, $items)
    {
        $this->page = $page;
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Companies::make()->setPage($this->page)->setItemsPerPage($this->items)->sync();
    }
}
