<?php

namespace App\Http\Livewire\Employee;

use App\Exports\StatisticsExport;
use App\Models\DesiredBeginning;
use App\Services\Statistics as StatisticsServices;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Statistics extends Component
{
    public $statistics = null;

    public array $desiredBeginnings;

    public $desiredBeginning;

    public $desiredBeginningId;

    public $date = null;

    public function mount()
    {
        $this->desiredBeginnings = $this->filterDesiredBeginning();

        $this->search();

        $this->date = ! $this->date
            ? now()->format('Y-m')
            : Carbon::parse($this->date.'-01')->endOfMonth()->format('Y-m');

        $this->desiredBeginning = $this->desiredBeginning ?? now()->toDateString();
    }

    private function filterDesiredBeginning(): array
    {
        return DesiredBeginning::options();
    }

    public function search()
    {
        $statistics = new StatisticsServices();
        $this->statistics = [
            'registerSubmit' => $statistics->registerSubmit('count'),
            'personalInformationCompleted' => $statistics->personalInformationCompleted('count'),
            'competencyCatchUp' => $statistics->competencyCatchUp('count'),
            'testTaken' => $statistics->testTaken('count'),
            'testPassed' => $statistics->testPassed('count'),
            'testFailed' => $statistics->testFailed('count'),
            'testFailedConfirmed' => $statistics->testFailedConfirmed('count'),
            'testResultPdfRetrieved' => $statistics->testResultPdfRetrieved('count'),
            'consentCompanyPortal' => $statistics->consentCompanyPortal('count'),
            'enrollment' => $statistics->enrollment('count'),
        ];
    }

    public function render()
    {
        return view('livewire.employee.statistics');
    }

    public function download()
    {
        return Excel::download(new StatisticsExport($this->date, $this->desiredBeginning), 'statistics.xlsx');
    }
}
