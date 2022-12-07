<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     *
     * @throws ValidationException
     */
    public function update($user, array $input): void
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'academic_title' => ['required', 'string', 'max:100'],
            'place_of_birth' => ['required', 'string', 'max:100'],
            'place_of_country' => ['required', 'string', 'max:100'],
            'citizenship_of_state' => ['required', 'string', 'max:100'],
            'gender' => ['required'],
            'course_id' => ['required'],
            'desired_beginning_id' => ['required'],
            'location' => ['required', 'string'],
            'address' => ['required', 'string'],
            'pin_code' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string','min:9'],
            'privacy_policy' => ['accepted'],
            'email' => ['required', 'email:rfc,dns,spoof', Rule::unique('users')->ignore($user->id)],
        ];

        if (! isset($input['day']) || ! isset($input['month']) || ! isset($input['year'])) {
            $rules['dob'] = ['required'];
        }

        if (! auth()->user()->profile_photo_path && ! isset($input['photo'])) {
            $rules['photo'] = ['required'];
        } elseif (auth()->user()->profile_photo_path && isset($input['photo'])) {
            $rules['photo'] = ['required', 'image', 'mimes:jpg,jpeg,png'];
        }

        Validator::make($input, $rules, [
            'first_name.required' => __('First Name is required'),
            'academic_title.required' => __('Academic title is required'),
            'place_of_birth.required' => __('Place of Birth is required'),
            'citizenship_of_state.required' => __('Citizenship  is required'),
            'place_of_country.required' => __('Country of Birth is required'),
            'pin_code.required' => __('Postcode is required'),
            'phone.required' => __('Telephone is required'),
            'dob.required' => __('The Date of Birth is required'),
            'gender.required' => __('The Gender is required'),
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'academic_title' => $input['academic_title'],
                'place_of_birth' => $input['place_of_birth'],
                'place_of_country' => $input['place_of_country'],
                'citizenship_of_state' => $input['citizenship_of_state'],
                'course_id' => $input['course_id'],
                'desired_beginning_id' => $input['desired_beginning_id'],
                'address' => $input['address'],
                'gender' => $input['gender'],
                'location' => $input['location'],
                'pin_code' => $input['pin_code'],
                'dob' => $input['year'].'-'.$input['month'].'-'.$input['day'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'terms_condition' => true,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser(mixed $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
