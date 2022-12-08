<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Makeable;

class DeleteRejectedApplicationData
{
    use Makeable;

    public function __construct(protected User $user)
    {
    }

    public function delete()
    {
        $this->user->values()->delete();
        $this->user->moodle()->delete();
        $this->user->meteor()->delete();
        $this->user->results()->delete();
        $this->user->media()->delete();
        $this->user->configuration()->delete();
    }
}