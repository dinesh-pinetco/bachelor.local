<?php

namespace App\Pdf;

use App\Models\User;
use Rjchauhan\LaravelFiner\Pdf\Pdf;

class SelectionTestFailedResultPdf extends Pdf
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function data()
    {
        return [
            'user' => $this->user,
            'street_house_number'=>$this->user->values->where('fields.key', 'street_house_number')->value('value'),
            'postal_code' => $this->user->values->where('fields.key', 'postal_code')->value('value'),
            'location' => $this->user->values->where('fields.key', 'location')->value('value'),
            'fail_pdf_created_at' => $this->user->configuration->fail_pdf_created_at,
            'qrcode' => base64_encode(\QrCode::format('svg')
                ->size(200)
                ->generate(route('applicant.test-result', ['hash' => base64_encode($this->user->email)]))),
        ];
    }
}
