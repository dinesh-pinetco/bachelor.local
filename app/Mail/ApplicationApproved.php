<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public User $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, protected $is_test_taken = false)
    {
        $this->applicant = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->subject(__('Your application was accepted').' | '.$this->applicant->courses()->first()->name.'| NORDAKADEMIE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('emails.application-approved-mail', [
                'link'          => route('selection-test.index'),
                'name'          => $this->applicant->full_name,
                'is_test_taken' => $this->is_test_taken,
            ]);
    }
}
