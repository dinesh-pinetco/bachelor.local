<?php

namespace App\Pdf;

use App\Models\User;
use Rjchauhan\LaravelFiner\Pdf\Pdf;

class SelectionTestPassedResultPdf extends Pdf
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
            'qrcode' => base64_encode(\QrCode::format('svg')
                ->size(200)
                ->generate(route('applicant.test-result', ['hash' => base64_encode($this->user->email)]))),
        ];
    }
}
