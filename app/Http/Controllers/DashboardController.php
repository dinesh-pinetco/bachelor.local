<?php

namespace App\Http\Controllers;

use App\Services\ProgressBar;

class DashboardController extends Controller
{
    public ProgressBar $progressBar;

    public function __construct(ProgressBar $progressBar)
    {
        $this->progressBar = $progressBar;
    }

    public function __invoke()
    {
        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE])) {
            return redirect(route('employee.dashboard'));
        }

        $profileProgress = $this->progressBar->calculateProgressByTab('profile');
        $motivateProgress = $this->progressBar->calculateProgressByTab('motivation');
        $careerProgress = $this->progressBar->calculateProgressByTab('career');
        $documentProgress = $this->progressBar->documentProgress();

        return view('dashboard', compact('profileProgress', 'motivateProgress', 'careerProgress', 'documentProgress'));
    }
}
