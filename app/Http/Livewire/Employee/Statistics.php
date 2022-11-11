<?php

namespace App\Http\Livewire\Employee;

use App\Exports\StatisticsExport;
use App\Models\DesiredBeginning;
use App\Services\Statistics as StatisticsServices;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Statistics extends Component
{
    public $statistics = null;

    public Collection $desiredBeginnings;

    public $desiredBeginning;

    public $desiredBeginningId;

    public $desiredBeginningDate;

    public $date = null;

    public function mount()
    {
        $this->desiredBeginnings = $this->filterDesiredBeginning();

        $this->search();

        $this->date = ! $this->date
            ? now()->format('Y-m')
            : Carbon::parse($this->date.'-01')->endOfMonth()->format('Y-m');

        $this->desiredBeginningDate = $this->desiredBeginningDate ?? Carbon::now();
    }

    private function filterDesiredBeginning(): Collection
    {
        $allDesiredBeginnings = new Collection();

        $desiredBeginnings = DesiredBeginning::get();

        $lastDate = Carbon::create(null, $desiredBeginnings->last()->month, $desiredBeginnings->last()->day)->addYear(MAX_YEAR);

        $desiredBeginnings->each(function ($desiredBeginning) use ($allDesiredBeginnings, $lastDate) {
            $startDate = Carbon::create(BEGINNING_YEAR, $desiredBeginning->month, $desiredBeginning->day);
            $allSemesters = CarbonPeriod::create($startDate, '1 year', $lastDate);
            foreach ($allSemesters as $semester) {
                $desiredBeginning = clone $desiredBeginning;
                $desiredBeginning->date = $semester;
                $desiredBeginning->unix_time = $semester->unix();
                $allDesiredBeginnings->push($desiredBeginning);
            }
        });

        return $allDesiredBeginnings->sortBy('unix_time')->values();
    }

    public function search()
    {
        $statistics = new StatisticsServices();
        $this->statistics = [
            'interested'        => $statistics->interested('count'),
            'approved'          => $statistics->approved('count'),
            'interviews'        => $statistics->interviews('count'),
            'competencyCatchUp' => $statistics->competencyCatchUp('count'),
            'contracts'         => $statistics->contracts('count'),
        ];
    }

    public function render()
    {
        return view('livewire.employee.statistics');
    }

    public function updated($value)
    {
        $this->desiredBeginnings = $this->filterDesiredBeginning();

        if ($value == 'desiredBeginning' && $this->desiredBeginning != null) {
            $desiredBeginning = $this->desiredBeginnings[$this->desiredBeginning];
            $this->desiredBeginningId = $desiredBeginning->id;
            $this->desiredBeginningDate = $desiredBeginning->date;
        }
    }

    public function download()
    {
        $this->desiredBeginnings = $this->filterDesiredBeginning();

        return Excel::download(new StatisticsExport($this->date, $this->desiredBeginningId, $this->desiredBeginningDate), 'statistics.xlsx');
    }
}
