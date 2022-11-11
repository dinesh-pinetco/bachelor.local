<?php

namespace App\Jobs;

use App\Hubspot\Contact;
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
    public function __construct(protected User $user, protected $application_status)
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
        $applicantStatus = \App\Services\Hubspot\Contact::make($this->user)->{$this->application_status}();

        $hubspotConfiguration = $this->user->hubspotConfiguration;
        Contact::make()
            ->update($hubspotConfiguration->contact_id, [$this->application_status => $applicantStatus]);
        $hubspotConfiguration->updateLastHubspotContactUpdatedAt();
    }
}
