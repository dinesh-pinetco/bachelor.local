<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncApplicantsToHubspotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $last_updated_at = now()->subDay();

        $applicants = User::role(ROLE_APPLICANT)
            ->doesntHave('hubspotConfiguration')
            ->orWhereHas('hubspotConfiguration', function ($q) use ($last_updated_at) {
                $q->where('user_updated_at', '>=', $last_updated_at)
                    ->where('last_hubspot_contact_updated_at', '<=', $last_updated_at);
            })
            ->get();

        foreach ($applicants as $applicant) {
            CreateOrUpdateApplicantDataToHubspotJob::dispatch($applicant);
        }
    }
}
