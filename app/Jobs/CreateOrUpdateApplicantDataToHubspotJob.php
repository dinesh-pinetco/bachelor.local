<?php

namespace App\Jobs;

use App\Hubspot\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrUpdateApplicantDataToHubspotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $applicantObject = \App\Services\Hubspot\Contact::make($this->user)->get();
        $hubspotContact = Contact::make()->updateOrCreate($this->user->email, $applicantObject);

        $this->user->hubspotConfiguration()
            ->updateOrCreate(['contact_id' => data_get($hubspotContact, 'vid')], ['last_hubspot_contact_updated_at' => now()]);
    }
}
