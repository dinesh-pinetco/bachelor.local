<?php

namespace App\Exports;

use App\Http\Resources\ExcelApplicantResource;
use App\Models\Document;
use App\Models\Field;
use App\Models\Test;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicantsExport implements FromCollection, WithHeadings
{
    public function __construct(public array $usersIds)
    {
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collection()
    {
        $usersData = User::whereIn('id', $this->usersIds)
            ->with([
                'courses',
                'values',
                'values.fields',
                'contract',
                'study_sheet',
                'government_form',
            ])
            ->get();

        return ExcelApplicantResource::collection($usersData);
    }

    public function headings(): array
    {
        $profile = [
            'bewerber_id',
            'bild',
            'vorname',
            'nachname',
            'e_mail',
            'akademischer_grad',
            'geburtstag',
            'geburtsort',
            'geschlecht',
            'geburtsland',
            'citizenship_id',
            'telefonnummer',
            'studiengangId',
            'studienbeginn',
            'eCTS_erststudium',
            'Kompetenznachholung',
            'datenschutzerklaerung',
            'Studiengang_eingeben',
            'Erworbener_Abschluss',
            'Monat/Jahr_des_Studienabschlusses',
            'Name_des_Unternehmens',
            'Beginn',
            'Ende',
            'grade',
        ];

        return array_merge(
            $profile,
            Field::where('group_id', 10)->pluck('label')->toArray(),
            Document::query()->pluck('name')->toArray(),
            Test::query()->pluck('name')->toArray(),
            [
                'government_form_submitted',
                'study_sheet_submitted',
                'vertrag_verschickt_am',
                'vertrag_zurueck_am',
                'strasse_und_hausnummer',
                'postleitzahl',
                'ort',
                'adresszusatz',
                'abweichender_empfaenger',
                'land',
            ]
        );
    }
}
