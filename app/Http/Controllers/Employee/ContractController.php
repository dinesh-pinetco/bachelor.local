<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\User;

class ContractController extends Controller
{
    public function show(User $applicant, Contract $contract)
    {
        return view('employee.applicants.contracts.show', compact('applicant', 'contract'));
    }
}
