<?php

namespace App\Policies;

use App\Enums\ApplicationStatus;
use App\Models\Test;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    public function perform(User $user, Test $test)
    {
        return $user->application_status->id() >= ApplicationStatus::PROFILE_INFORMATION_COMPLETED->id();
    }
}
