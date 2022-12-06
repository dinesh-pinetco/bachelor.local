<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestResultVerifyController extends Controller
{
    public function __invoke($hash)
    {
        $user = User::with(
            ['values' => function ($q) {
                $q->whereHas('fields', function ($q) {
                    $q->whereIn('key', ['first_name', 'postal_code', 'location', 'date_of_birth']);
                })->with('fields');
            }]
        )->where('email', base64_decode($hash))->first();

        if (! $user) {
            abort(404);
        }

        $firstName = $user->values->where('fields.key', 'first_name')->value('value');

        $zipCode = $user->values->where('fields.key', 'postal_code')->value('value');

        $city = $user->values->where('fields.key', 'location')->value('value');

        $date_of_birth = $user->values->where('fields.key', 'date_of_birth')->value('value');

        return view('verify', compact(['user', 'firstName', 'zipCode', 'city', 'date_of_birth']));
    }
}
