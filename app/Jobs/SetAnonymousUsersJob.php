<?php

namespace App\Jobs;

use App\Console\Commands\SetAnonymouseUsers;
use App\Models\User;
use App\Services\MakeAnonymousUser;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
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
     *
     * @return void
     */
    public function handle(): void
    {
        User::where('created_at', '<', Carbon::now()->subYears(ANONYMOUS_USER_YEARS))->role(ROLE_APPLICANT)->get()->each( function ($user){
            MakeAnonymousUser::make($user)->execute();
        });

    }
}
