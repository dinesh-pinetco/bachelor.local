<?php

namespace App\Jobs;

use App\Hubspot\Contact;
use App\Models\ApplicationStatus;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApplicantStatusUpdateToHubspotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected User $user, protected $application_status_id)
    {
        $this->user = $user->load('hubspotConfiguration');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $application_status_name = ApplicationStatus::where('id', $this->application_status_id)->value('identifier');
        $applicantStatus = \App\Services\Hubspot\Contact::make($this->user)->{$application_status_name}();

        $hubspotConfiguration = $this->user->hubspotConfiguration;
        Contact::make()
            ->update($hubspotConfiguration->contact_id, [$application_status_name => $applicantStatus]);
        $hubspotConfiguration->updateLastHubspotContactUpdatedAt();
    }
}
