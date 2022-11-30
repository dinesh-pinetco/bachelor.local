<?php

namespace App\Pdf;

use App\Models\User;
use Rjchauhan\LaravelFiner\Pdf\Pdf;

class SelectionTestNegativeResult extends Pdf
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
            'email' => base64_encode($this->user->email),
        ];
    }
}
