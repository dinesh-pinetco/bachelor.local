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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable'],
            'course_id' => ['required'],
            'desired_beginning' => ['required'],
        ], [], [
            'first_name' => 'Vorname',
            'last_name' => 'Nachname',
            'email' => 'E-Mail Adresse',
            'phone' => 'Phone',
            'course_id' => 'Studiengang',
            'desired_beginning' => 'gewünschter Beginn',
        ])->validate();

        $password = Str::random('10');

        $user = User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($password),
            'application_status' => ApplicationStatus::REGISTRATION_SUBMITTED,
        ])->assignRole(ROLE_APPLICANT);

        $user->attachCourseWithDesiredBeginning(data_get($input, 'course_id'), data_get($input, 'desired_beginning_id'), data_get($input, 'course_start_date'));

        Mail::to($user)->send(new UserCreated($user, $password));

        $syncUser = new SyncUserValue($user);
        $syncUser();

        return $user;
    }
}
