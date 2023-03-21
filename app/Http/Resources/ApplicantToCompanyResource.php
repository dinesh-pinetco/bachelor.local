<?php

namespace App\Http\Resources;

use App\Models\Field;
use App\Models\Nationality;
use App\Models\Tab;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ApplicantToCompanyResource extends JsonResource
{
    private $user;

    private $mainAddress;

    public function toArray($request): array
    {
        $this->user = $this;

        return [
            'bewerber_id' => $this->id,
            'last_change' => $this->last_data_updated_at,
            'anonymisiert' => (bool) $this->getValueByIdentifier('is_anonymous'),
            'testlaufBestanden' => $this->hasExamPassed(),
            'barCode' => $this->testResultBarcode(),
            'bild' => $this->getValueByIdentifier('avatar') ? base64_encode(file_get_contents(Storage::url($this->getValueByIdentifier('avatar')))) : null,
            'person' => [
                'vorname' => $this->getValueByIdentifier('first_name'),
                'nachname' => $this->getValueByIdentifier('last_name'),
                'akademischer_grad' => $this->getValueByIdentifier('academic_degree'),
                'geburtstag' => $this->getValueByIdentifier('date_of_birth'),
                //                'geburtsort' => $this->getValueByIdentifier('place_of_birth'),
                'geschlecht' => $this->getValueByIdentifier('gender'),
            ],
            'adresse' => $this->getAddress('1'),
            'telefonnummer' => [
                'typ' => 2,
                'telefonnummer' => $this->getValueByIdentifier('phone'),
            ],
            'private_e_mail_adresse' => [
                'typ' => 1,
                'e_mail' => $this->getValueByIdentifier('email'),
            ],
            'motivation' => ApplicantMotivationResource::collection($this->filterFieldData('motivation')),
            'documents' => ApplicantDocumentResource::collection($this->documents),
            'selection-tests' => SelectionTestResultResource::collection($this->results),
            'show_application_on_marketplace_at' => $this->show_application_on_marketplace_at,
            'bewerbungen' => ApplicantCompanyResource::collection($this->companies),

            //TODO:-  all following Fields are not in the client sample json
            //            'rechnungsadresse' => $this->getAddress('3'),
            //            'lieferadresse' => $this->getAddress('4'),
            //            'studienbeginn' => $this->desiredBeginning->course_start_date,
            //            'datenschutzerklaerung' => filter_var($this->getValueByIdentifier('privacy_policy'), FILTER_VALIDATE_BOOLEAN),
            //            'geburtsland' => $this->getValueByIdentifier('nationality_id'),
            //            'studiengangId' => $this->courses()->first()->course->sana_id,
            //            'eCTS_erststudium' => $this->getValueByIdentifier('ects_point'),
            //            'Kompetenznachholung' => $this->configuration?->competency_catch_up,
        ];
    }

    private function getValueByIdentifier($identifier)
    {
        $fieldValue = $this->user->values->filter(function ($item) use ($identifier) {
            return $item->fields->key == $identifier;
        })->first();
        $value = $fieldValue == null ? '' : $fieldValue->value;
        if ($identifier == 'nationality_id') {
            return Nationality::where('id', $value)->value('name');
        }

        if ($identifier == 'gender') {
            $genders = [
                'male' => 1,
                'female' => 2,
                'other' => 3,
            ];

            return data_get($genders, $value);
        }

        return $value;
    }

    private function getAddress($type): array
    {
        $address = [];
        if ($type == 1) {
            $address = $this->mainAddress = [
                'typ' => 1,
                'strasse_und_hausnummer' => $this->getValueByIdentifier('street_house_number'),
                'postleitzahl' => $this->getValueByIdentifier('postal_code'),
                'ort' => $this->getValueByIdentifier('location'),
                'adresszusatz' => '',
                'abweichender_empfaenger' => '',
                'land' => '',
            ];
        } elseif ($type == 3) {
            if ($this->user->study_sheet?->billing_address == 1) {
                $address = $this->mainAddress;
                $address['typ'] = 3;
            } elseif ($this->user->study_sheet?->billing_address) {
                $address = [
                    'typ' => 3,
                    'strasse_und_hausnummer' => $this->user->study_sheet->custom_billing_address['address'],
                    'postleitzahl' => $this->user->study_sheet->custom_billing_address['postal_code'],
                    'ort' => $this->user->study_sheet->custom_billing_address['location'],
                    'adresszusatz' => $this->user->study_sheet->custom_billing_address['address_suffix'],
                    'abweichender_empfaenger' => $this->user->study_sheet->custom_billing_address['name'],
                    'land' => $this->user->study_sheet->custom_billing_address['country'],
                ];
            }
        }

        return $address;
    }

    private function getValue($object)
    {
        $key = 'sana_id';

        return $object != null ? $object->{$key} : null;
    }

    private function filterFieldData(string $string)
    {
        return collect($this->values)
            ->whereIn('field_id', Field::where('tab_id', Tab::where('slug', $string)->value('id'))->pluck('id'))
            ->values();
    }
}
