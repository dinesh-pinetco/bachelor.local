<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Statistics;
use App\Services\ExportStatistics;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class StatisticsExport implements FromCollection, WithHeadings, WithStrictNullComparison, WithCustomStartCell, WithEvents
{
    public Carbon $date;

    public $desiredBeginningId;

    public $desiredBeginningDate;

    public ExportStatistics $statistics;

    public $storeStatistics;

    public array $data = [];

    public function __construct($date, $desiredBeginningId, $desiredBeginningDate)
    {
        $this->date = Carbon::parse("$date-01");
        $this->desiredBeginningId = $desiredBeginningId;
        $this->desiredBeginningDate = $desiredBeginningDate;
        $this->statistics = (new ExportStatistics($this->desiredBeginningDate));
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function collection(): Collection
    {
        $this->setFirstRow();
        $this->setMiddleRows();
        $this->setLastRow();

        return collect($this->data);
    }

    public function setFirstRow()
    {
        $this->data[] = [
            $this->date->format('Y M'),
            'Summe',
            'ECTS',
            'abgelehnt',
            'offen',
            'eingereicht',
            'abgelehnt',
            'akzeptiert',
            'abgelehnt',
            'absolviert',
            'abgelehnt',
            'absolviert',
            'abgelehnt',
            'verschickt',
            'abgel.v.Vertrag',
            'zuruck',
            'abgel.n.Vertrag',
            'Summe',
        ];
    }

    public function setMiddleRows()
    {
        $courses = Course::whereRelation('desired_beginnings', 'id', $this->desiredBeginningId)
            ->where('first_start', '<=', $this->desiredBeginningDate)
            ->where(function ($query) {
                $query->whereNull('last_start')->orWhere('last_start', '>=', $this->desiredBeginningDate);
            })
            ->orderBy('sort_order')
            ->get();
        foreach ($courses as $course) {
            $this->getStatisticsInDb($course->id);
            $this->data[] = [
                $course->name,
                $this->getValue('totalApplicants', $course->id),
                $this->getValue('checkedCompetencyCatchUp', $course->id),
                $this->getValue('rejectedApplicants', $course->id),

                $this->getValue('incompleteApplications', $course->id),
                $this->getValue('submittedApplications', $course->id),
                $this->getValue('rejectedApplicationsBeforeSubmittedStage', $course->id),
                $this->getValue('approvedApplications', $course->id),
                $this->getValue('rejectedApplicationsBeforeApprovedStage', $course->id),

                $this->getValue('testCompleted', $course->id),
                $this->getValue('rejectedApplicationsBeforeTestStage', $course->id),

                $this->getValue('completedInterviews', $course->id),
                $this->getValue('rejectedApplicationsBeforeInterviewStage', $course->id),

                $this->getValue('contractSent', $course->id),
                $this->getValue('rejectedApplicationsBeforeContractSent', $course->id),
                $this->getValue('contractReturn', $course->id),
                $this->getValue('rejectedApplicationsBeforeContractReturn', $course->id),

                $this->getValue('applicationEnroll', $course->id),
            ];
        }
    }

    public function getStatisticsInDb($courseId)
    {
        if ($this->date->format('Y M') != Carbon::now()->format('Y M')) {
            $this->storeStatistics = Statistics::where('course_id', $courseId)
                ->whereYear('desired_beginning_date', $this->desiredBeginningDate->year)
                ->whereMonth('desired_beginning_date', $this->desiredBeginningDate->month)
                ->whereYear('created_at', $this->date->year)
                ->whereMonth('created_at', $this->date->month)
                ->first();
        }
    }

    private function getValue($filteredBy, $courseId)
    {
        if ($this->date->format('Y M') == Carbon::now()->format('Y M')) {
            return $this->statistics->getApplicantsByFilter($filteredBy, 'count', $courseId);
        } else {
            return $this->storeStatistics?->{camelCaseToSnakeCase($filteredBy)} ?? 0;
        }
    }

    public function setLastRow()
    {
        $this->data[] = [
            'Summe',
            array_sum(array_column($this->data, 1)),
            array_sum(array_column($this->data, 2)),
            array_sum(array_column($this->data, 3)),
            array_sum(array_column($this->data, 4)),
            array_sum(array_column($this->data, 5)),
            array_sum(array_column($this->data, 6)),
            array_sum(array_column($this->data, 7)),
            array_sum(array_column($this->data, 8)),
            array_sum(array_column($this->data, 9)),
            array_sum(array_column($this->data, 10)),
            array_sum(array_column($this->data, 11)),
            array_sum(array_column($this->data, 12)),
            array_sum(array_column($this->data, 13)),
            array_sum(array_column($this->data, 14)),
            array_sum(array_column($this->data, 15)),
            array_sum(array_column($this->data, 16)),
            array_sum(array_column($this->data, 17)),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $sheet->setCellValue('A1', 'Studiengang');

                $sheet->mergeCells('B1:D1');
                $sheet->setCellValue('B1', 'Bewerber insgesamt');

                $sheet->mergeCells('E1:I1');
                $sheet->setCellValue('E1', 'Bewerbung akzeptieren');

                $sheet->mergeCells('J1:K1');
                $sheet->setCellValue('J1', 'Test');

                $sheet->mergeCells('L1:M1');
                $sheet->setCellValue('L1', 'Gesprch');

                $sheet->mergeCells('N1:Q1');
                $sheet->setCellValue('N1', 'Vertrag');

                $sheet->setCellValue('R1', 'Immatrikuliert');

                $styleArray = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:R1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }

    public function headings(): array
    {
        return [
            $this->date->format('Y M'),
            'Summe',
            'ECTS',
            'abgelehnt',
            'offen',
            'akzeptiert',
            'eingereicht',
            'akzeptiert',
            'abgelehnt',
            'absolviert',
            'abgelehnt',
            'absolviert',
            'abgelehnt',
            'verschickt',
            'abgel.v.Vertrag',
            'zurück',
            'abgel.n.Vertrag',
            'Summe',
        ];
    }
}
