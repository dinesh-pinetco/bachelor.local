<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractPdfSend extends Mailable
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
        return $this->subject(__('Contract PDF').'| NORDAKADEMIE')
            ->markdown('emails.contract-pdf', [
                'name' => $this->user->full_name,
                'applicant_id' => $this->user->id,
            ])
            ->attach(storage_path('app/'.$this->user->configuration->contract_pdf_path));
    }
}
