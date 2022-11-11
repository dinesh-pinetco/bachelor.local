<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SannaUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SannaUserController extends Controller
{
    public function index()
    {
        $size = request()->get('size') ?? 15;

        $users = User::where('application_status_id', '=', User::STATUS_CONTRACT_RETURNED_ON)
            ->where('is_sync', false)
            ->whereHas('study_sheet', function ($query) {
                $query->where('is_submit', 1);
            })
            ->whereHas('government_form', function ($query) {
                $query->where('is_submit', 1);
            })
            ->with([
                'course',
                'values',
                'values.fields',
                'interview',
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
            ])
            ->paginate($size)
            ->withQueryString();

        return SannaUserResource::collection($users);
    }

    public function interviewOn()
    {
        $size = request()->get('size') ?? 15;

        $users = User::where('application_status_id', '=', User::STATUS_SELECTION_INTERVIEW_ON)
            ->where('is_sync', false)
            ->with([
                'course',
                'values',
                'values.fields',
                'interview',
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

        User::where('id', $request->applicant_id)->update(['is_sync' => 1]);

        return response()->json(['message' => __('User sync successfully.')]);
    }
}
