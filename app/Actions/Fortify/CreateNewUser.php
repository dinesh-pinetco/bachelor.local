<?php

namespace App\Actions\Fortify;

use App\Enums\ApplicationStatus;
use App\Mail\UserCreated;
use App\Models\User;
use App\Services\SyncUserValue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return User
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required', 'string', 'email:rfc,dns,spoof',
                function ($attribute, $value, $fail) use ($input) {
                    $user = User::where('email', $value)
                        ->with('desiredBeginning')
                        ->first();

                    if ($user && $this->applicantHasRejectedStatus($user) &&
                        ($user->desiredBeginning?->course_start_date >= data_get($input, 'desired_beginning'))
                    ) {
                        $fail(__('The desired beginning is invalid.'));
                    }

                    if ($user && !$this->applicantHasRejectedStatus($user)) {
                        $fail(__('The :attribute has already been taken'), ['attribute' => $attribute]);
                    }
                },
            ],
            'phone' => ['nullable', 'numeric', 'min:9'],
            'desired_beginning' => ['required', 'date'],
            'course_ids' => ['required', 'array'],
        ], [], [
            'first_name' => 'Vorname',
            'last_name' => 'Nachname',
            'email' => 'E-Mail Adresse',
            'phone' => 'Phone',
            'desired_beginning' => 'gewünschter Beginn',
            'course_ids' => 'Studiengang',
        ])->validate();

        $password = Str::random('10');

        $user = User::updateOrCreate([
            'email' => $input['email'],
        ], [
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'password' => Hash::make($password),
            'application_status' => ApplicationStatus::REGISTRATION_SUBMITTED,
            'is_active' => true,
        ])->assignRole(ROLE_APPLICANT);

        $user->attachCourseWithDesiredBeginning(data_get($input, 'desired_beginning'), data_get($input, 'course_ids'));
        Mail::to($user)->send(new UserCreated($user, $password));

        $syncUser = new SyncUserValue($user);
        $syncUser();

        return $user;
    }

    private function applicantHasRejectedStatus(User $user): bool
    {
        return in_array($user->application_status, [ApplicationStatus::APPLICATION_REJECTED_BY_NAK, ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT]);
    }
}
