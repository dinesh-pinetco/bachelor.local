<?php

namespace App\Console\Commands;

use App\Models\Result;
use App\Models\Test;
use App\Services\Cubia;
use App\Services\Meteor;
use App\Services\Moodle;
use Illuminate\Console\Command;

class SyncTestResults extends Command
{
    protected $signature = 'sync:results';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $results = Result::where('status', Result::STATUS_STARTED)->get();

        foreach ($results as $result) {
            $test = $result->test;
            if ($test->type == Test::TYPE_METEOR && $result->user) {
                (new Meteor($result->user))->fetchResult($result);
            } elseif ($test->type == Test::TYPE_MOODLE && $result->user) {
                (new Moodle($result->user))->fetchResult($result);
            }
        }

        (new Cubia())->fetchResult();
    }
}
