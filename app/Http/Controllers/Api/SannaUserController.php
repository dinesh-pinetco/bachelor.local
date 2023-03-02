<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SannaUserResource;
use App\Models\ApplicantCompany;
use App\Models\Company;
use App\Models\User;
use App\Models\UserConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SannaUserController extends Controller
{
    public function index()
    {
        $size = request()->get('size') ?? 15;

        $users = User::query()
            ->role(ROLE_APPLICANT)
            ->whereHas('configuration', function ($query) {
                $query->where('is_synced_to_sanna', false);
            })
            ->whereHas('study_sheet', function ($query) {
                $query->where('is_submit', true);
            })
            ->whereHas('government_form', function ($query) {
                $query->where('is_submit', true);
            })
            ->with([
                'courses',
                'values',
                'values.fields',
                'contract',
                'study_sheet.health_insurance_companies',
                'government_form' => function ($q) {
                    $q->with([
                        'country', 'second_country',
                        'previous_residence_country',
                        'previous_residence_state',
                        'previous_residence_district',
                        'current_residence_country',
                        'current_residence_state',
                        'current_residence_district',
                        'enrollment_university',
                        'enrollment_country',
                        'graduation_entrance_qualification',
                        'graduation_country',
                        'graduation_state',
                        'graduation_district',
                        'previous_college',
                        'previous_college_country',
                        'previous_study_type',
                        'previous_final_exam',
                        'previous_course',
                        'previous_second_course',
                        'previous_third_course',
                        'last_exam_university',
                        'last_exam_country',
                        'last_exam',
                        'last_study_type',
                        'last_exam_course',
                        'last_exam_second_course',
                        'last_exam_third_course',
                    ]);
                },
                'companies.company',
            ])
            ->paginate($size)
            ->withQueryString();

        return SannaUserResource::collection($users);
    }

    public function userSync(Request $request): JsonResponse
    {
        $request->validate([
            'applicant_id' => 'required|exists:users,id',
        ]);

        UserConfiguration::updateOrCreate(
            ['user_id' => $request->applicant_id],
            ['is_synced_to_sanna' => true]);

        return response()->json(['message' => __('User sync successfully.')]);
    }

    public function userHired(Company $company, User $user)
    {
        $userContactedToCompany = $user->companies()->where('company_id', $company->id)->latest()->first();

        if ($userContactedToCompany) {
            $userContactedToCompany->update(['hired_at' => now()]);
        } else {
            ApplicantCompany::create([
                'user_id' => $user->id,
                'company_id' => $company->id,
                'company_contacted_at' => now(),
                'hired_at' => now(),
            ]);
        }

        return response()->json(['message' => __('User hired successfully.')]);
    }
}
