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
            'interested' => $statistics->interested('count'),
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
