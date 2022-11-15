<?php

namespace App\Http\Livewire\Employee\Applicants\SelectionTests;

use App\Models\Result;
use App\Models\Test;
use App\Models\User;
use App\Services\SelectionTests\Cubia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Throwable;

class Show extends Component
{
    use AuthorizesRequests;

    public Test $test;

    public User $applicant;

    public Result $result;

    public bool $isEdit = false;

    public bool $isShow = true;

    public function mount()
    {
        $this->result = $this->test->results()?->myResults($this->applicant)?->first();

        try {
            if ($this->authorizeForUser($this->applicant, 'update', $this->result)) {
                $this->isEdit = true;
            } elseif ($this->authorizeForUser($this->applicant, 'create', Result::class)) {
                $this->isEdit = true;
            }
        } catch (Throwable $th) {
            $this->isEdit = false;
        }
    }

    public function render()
    {
        return view('livewire.employee.applicants.selection-tests.show');
    }

    public function markAsPassed()
    {
        if ($this->authorizeForUser($this->applicant, 'update', $this->result)) {
            $this->result->is_passed = true;
            $this->result->status = Result::STATUS_COMPLETED;
            $this->result->passed_by_nak = true;
            $this->result->failed_by_nak = false;
            $this->result->save();
        }
        $this->applicant->saveApplicationStatus();

        $this->toastNotify(__('Selection test passed successfully.'), __('Success'), TOAST_SUCCESS);
        $this->testRefresh();
    }

    public function markAsFailed()
    {
        if ($this->authorizeForUser($this->applicant, 'update', $this->result)) {
            $this->result->is_passed = false;
            $this->result->status = Result::STATUS_FAILED;
            $this->result->failed_by_nak = true;
            $this->result->save();
        }

        $this->applicant->saveApplicationStatus();
        $this->toastNotify(__('Selection test failed successfully.'), __('Success'), TOAST_SUCCESS);
        $this->testRefresh();
    }

    public function markAsReset()
    {
        if ($this->authorizeForUser($this->applicant, 'update', $this->result)) {
            $this->result->is_passed = false;
            $this->result->status = Result::STATUS_NOT_STARTED;
            $this->result->passed_by_nak = false;
            $this->result->failed_by_nak = false;
            $this->result->result = null;
            $this->result->save();
            if ($this->result->test->type == Test::TYPE_CUBIA) {
                $cubiaMIXTestResetURL = (new Cubia())->generateTestUrl($this->result->user, 'MIX', true);
                $response = Http::get($cubiaMIXTestResetURL);

                $cubiaIQTTestResetURL = (new Cubia())->generateTestUrl($this->result->user, 'IQT', true);
                $response = Http::get($cubiaIQTTestResetURL);
            }
        }
        $this->toastNotify(__('Selection test reset successfully.'), __('Success'), TOAST_SUCCESS);
        $this->testRefresh();
    }

    private function testRefresh()
    {
        $this->test = $this->test->fresh();
    }
}
