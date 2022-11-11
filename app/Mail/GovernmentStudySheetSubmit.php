<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GovernmentStudySheetSubmit extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->subject(__('Government And Study Sheet Form Submit.').' | '.$this->user->courses()->first()->name.'| NORDAKADEMIE')
            ->markdown('emails.government-study-sheet-submit', [
                'link'         => route('selection-test.index'),
                'name'         => $this->user->full_name,
                'applicant_id' => $this->user->id,
            ]);
    }
}
