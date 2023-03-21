<?php

namespace App\Http\Controllers\Api;

use App\Enums\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRejectionValidate;
use App\Http\Resources\ApplicantToCompanyResource;
use App\Models\ApplicantCompany;
use App\Models\User;

class ApplicantApplyToCompanyController extends Controller
{
    public function index()
    {
        $size = request()->get('itemsPerPage') ?? 15;
        $hasPagination = request()->get('pagination') == 'true';

        $users = User::query()
            ->role(ROLE_APPLICANT)
            ->filter()
            ->where('application_status', ApplicationStatus::APPLIED_TO_SELECTED_COMPANY)
            ->with([
                'courses',
                'values',
                'values.fields',
                'companies.company',
                'results.test',
                'documents',
            ]);

        if ($hasPagination) {
            $users = $users->paginate($size);
        } else {
            $users = $users->get();
        }

        return ApplicantToCompanyResource::collection($users);
    }

    public function show(User $user)
    {
        $user->load([
            'courses',
            'values',
            'values.fields',
            'companies.company',
            'results.test',
            'documents',
        ]);

        return ApplicantToCompanyResource::make($user);
    }

    /**
     * applicant rejected by company .
     * ablehnung boolean
     * bewerberId User
     * unternehmenId Company
     * @return userresouece json
     */
    public function applicantRejection(ApplicationRejectionValidate $request, User $user)
    {
        $applicantCompany = ApplicantCompany::where('user_id', request()->bewerberId)->where('company_id', request()->unternehmenId);
        if ($applicantCompany->exists()) {
            $applicantCompany->touch('company_rejected_at');
        } else {
            ApplicantCompany::create([
                'user_id' => request()->bewerberId,
                'company_id' => request()->unternehmenId,
                'company_rejected_at' => now(),
            ]);
        }

        $user->load([
            'courses',
            'values',
            'values.fields',
            'companies.company',
            'results.test',
            'documents',
        ]);

        return ApplicantToCompanyResource::make($user);
    }
}
