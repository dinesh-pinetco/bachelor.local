<?php

namespace App\Http\Controllers\Api;

use App\Enums\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateApplicationRejectionRequest;
use App\Http\Resources\ApplicantToCompanyResource;
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

    public function applicantRejection(CreateApplicationRejectionRequest $request, User $user)
    {
        $request->persist($user);

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
