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

    public $desiredBeginningDate;

    public ExportStatistics $statistics;

    public $storeStatistics;

    public array $data = [];

    public function __construct($date, $desiredBeginningDate)
    {
        $this->date = Carbon::parse("$date-01");
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
            'abgelehnt',
            'Registration submitted',
            'Personal data entered (Step 1)',
            'Test taken',
            'Test passed',
            'Test failed',
            'Test failed (confirmed)',
            'Result-PDF downloaded on',
            'Data completed after test passed',
            'Consent to company portal',
            'Approved by company for enrollment',
            'Summe',
        ];
    }

    public function setMiddleRows()
    {
        $courses = Course::where('first_start', '<=', $this->desiredBeginningDate)
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
                $this->getValue('rejectedApplicants', $course->id),

                $this->getValue('registration_submitted', $course->id),
                $this->getValue('profile_information_completed', $course->id),
                $this->getValue('testCompleted', $course->id),
                $this->getValue('testPassed', $course->id),
                $this->getValue('test_failed', $course->id),
                $this->getValue('test_failed_confirm', $course->id),
                $this->getValue('test_result_pdf_retrieved_on', $course->id),
                $this->getValue('personal_data_completed', $course->id),
                $this->getValue('consent_to_company_portal_bulletin_board', $course->id),
                $this->getValue('applicationEnroll', $course->id),
            ];
        }
        // dd($this->data);
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
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $sheet->setCellValue('A1', 'Studiengang');

                $sheet->mergeCells('B1:C1');
                $sheet->setCellValue('B1', 'Bewerber insgesamt');

                $sheet->mergeCells('D1:E1');
                $sheet->setCellValue('D1', 'Bewerbung akzeptieren');

                $sheet->mergeCells('F1:J1');
                $sheet->setCellValue('F1', 'Test');

                $sheet->mergeCells('K1:M1');
                $sheet->setCellValue('K1', 'Gesprch');

                $sheet->setCellValue('N1', 'Immatrikuliert');
                $sheet->setCellValue('N3','=SUM(C3:M3)');
                $sheet->setCellValue('N4','=SUM(C4:M4)');
                $sheet->setCellValue('N5','=SUM(C5:M5)');
                $sheet->setCellValue('N6','=SUM(C6:M6)');
                $sheet->setCellValue('N7','=SUM(C7:M7)');
                $sheet->setCellValue('N8','=SUM(C8:M8)');
                $sheet->setCellValue('N9','=SUM(N3:N8)');

                $styleArray = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:N1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }

    public function headings(): array
    {
        return [
            $this->date->format('Y M'),
            'Summe',
            'abgelehnt',
            'Registration submitted',
            'Personal data entered (Step 1)',
            'Test taken',
            'Test passed',
            'Test failed',
            'Test failed (confirmed)',
            'Result-PDF downloaded on',
            'Data completed after test passed',
            'Consent to company portal',
            'Approved by company for enrollment',
            'Summe',
        ];
    }
}
