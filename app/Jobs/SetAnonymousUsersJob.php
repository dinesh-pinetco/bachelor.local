<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\MakeAnonymousUser;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SetAnonymousUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     */
    public function handle(): void
    {
        User::query()
            ->role(ROLE_APPLICANT)
            ->whereNotNull('email')
            ->with('desiredBeginning')
            ->whereHas('desiredBeginning', function ($beginningQuery) {
                $beginningQuery->where('course_start_date', '<', Carbon::now()->subYears(ANONYMOUS_USER_YEARS));
            })
            ->chunk(100, function ($users) {
                foreach ($users as $user) {
                    MakeAnonymousUser::make($user)->execute();
                }
            });
    }
}
