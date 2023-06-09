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
            'user' => $this->user->load('desiredBeginning.courses'),
            'street_house_number' => $this->user->values->where('fields.key', 'street_house_number')->value('value'),
            'postal_code' => $this->user->values->where('fields.key', 'postal_code')->value('value'),
            'location' => $this->user->values->where('fields.key', 'location')->value('value'),
            'courses' => implode(',', $this->user->desiredBeginning->courses->pluck('name')->toArray()),
            'fail_pdf_created_at' => $this->user->configuration->fail_pdf_created_at,
            'qrcode' => $this->user->testResultBarcode(),
        ];
    }
}
