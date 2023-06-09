<?php

namespace App\Http\Resources;

use App\Models\Document;
use App\Models\Field;
use App\Models\Test;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExcelApplicantResource extends JsonResource
{
    use _ApplicantHelper;

    private $user;

    private $mainAddress;

    public function toArray($request): array
    {
        $this->user = $this;

        $profile = [
            'bewerber_id' => $this->id,
            'bild' => $this->study_sheet?->student_id_card_photo_url
                ?? ($this->getValueByIdentifier('avatar')
                    ? Storage::url($this->getValueByIdentifier('avatar'))
                    : null),
            'vorname' => $this->getValueByIdentifier('first_name'),
            'nachname' => $this->getValueByIdentifier('last_name'),
            'e_mail' => $this->getValueByIdentifier('email'),
            'akademischer_grad' => $this->getValueByIdentifier('academic_degree'),
            'geburtstag' => $this->getValueByIdentifier('date_of_birth'),
            'geburtsort' => $this->getValueByIdentifier('place_of_birth'),
            'geschlecht' => $this->getValueByIdentifier('gender'),
            'geburtsland' => $this->getValueByIdentifier('nationality_id'),
            'citizenship_id' => $this->getValueByIdentifier('citizenship_id'),
            'telefonnummer' => $this->getValueByIdentifier('phone'),
            'studiengangId' => $this->selectedCourses(),
            'studienbeginn' => $this->desiredBeginnings->course_start_date,
            'eCTS_erststudium' => $this->getValueByIdentifier('ects_point'),
            'Kompetenznachholung' => $this->competency_catch_up,
            'datenschutzerklaerung' => filter_var($this->getValueByIdentifier('privacy_policy'), FILTER_VALIDATE_BOOLEAN),

            'Studiengang_eingeben' => $this->getValueByLabel('Studiengang eingeben'),
            'Erworbener_Abschluss' => $this->getValueByLabel('Erworbener Abschluss'),
            'Monat/Jahr_des_Studienabschlusses' => $this->getValueByLabel('Monat/Jahr des Studienabschlusses'),

            'Name_des_Unternehmens' => $this->getValuesByLabel('Name des Unternehmens'),
            'Beginn' => $this->getValuesByLabel('Beginn'),
            'Ende' => $this->getValuesByLabel('Ende'),
            'grade' => $this->getValueByIdentifier('grade'),
        ];

        return array_merge(
            $profile,
            $this->motivations(),
            $this->documents(),
            $this->results(),
            $this->contract(),
            $this->getAddress(),
        );
    }

    private function getValueByLabel($label)
    {
        $fieldValue = $this->user->values->filter(function ($item) use ($label) {
            return $item->fields->label == $label;
        })->first();

        return $fieldValue == null ? '' : $fieldValue->value;
    }

    private function getValuesByLabel($label)
    {
        $fieldValue = $this->user->values->filter(function ($item) use ($label) {
            return $item->fields->label == $label;
        })->pluck('value');

        return $fieldValue == null ? '' : $fieldValue->implode(' | ');
    }

    private function getAddress(): array
    {
        return [
            'strasse_und_hausnummer' => $this->getValueByIdentifier('street_house_number'),
            'postleitzahl' => $this->getValueByIdentifier('postal_code'),
            'ort' => $this->getValueByIdentifier('location'),
            'adresszusatz' => '',
            'abweichender_empfaenger' => '',
            'land' => '',
        ];
    }

    private function motivations()
    {
        $fields = Field::where('group_id', 10)->get();
        $array = [];
        foreach ($fields as $field) {
            $array[$field->label] = $this->getValueByLabel($field->label);
        }

        return $array;
    }

    private function documents()
    {
        $array = [];
        $documents = Document::query()->get();
        foreach ($documents as $document) {
            $array[$document->name] = $this->media->where('mediable_id', $document->id)->first()?->url;
        }

        return $array;
    }

    private function results()
    {
        $tests = Test::all();
        $array = [];

        foreach ($tests as $test) {
            $array[$test->name] = $this->results->where('test_id', $test->id)->first()?->result;
        }

        return $array;
    }

    private function contract()
    {
        return [
            'government_form_submitted' => $this->government_form?->is_submit,
            'study_sheet_submitted' => $this->study_sheet?->is_submit,

            'vertrag_verschickt_am' => $this->contract?->send_date,
            'vertrag_zurueck_am' => $this->contract?->receive_date,
        ];
    }
}
