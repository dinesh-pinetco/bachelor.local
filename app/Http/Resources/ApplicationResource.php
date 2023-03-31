<?php

namespace App\Http\Resources;

use App\Models\Course;
use App\Models\Field;
use App\Models\Nationality;
use App\Models\Tab;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    private $user;

    private $mainAddress;

    public function toArray($request): array
    {
        $this->user = $this;

        return [
            'bewerber_id' => $this->id,
            'last_changed' => $this->last_data_updated_at,
            'anonymisiert' => (bool) $this->getValueByIdentifier('is_anonymous'),
            'testlaufBestanden' => $this->hasExamPassed(),
            'bild' => $this->getValueByIdentifier('avatar')
                ? base64_encode(file_get_contents(route('storage.url', ['path' => $this->getValueByIdentifier('avatar')])))
                : null,
            'person' => [
                'vorname' => $this->getValueByIdentifier('first_name'),
                'nachname' => $this->getValueByIdentifier('last_name'),
                'akademischer_grad' => $this->getValueByIdentifier('academic_degree'),
                'geburtstag' => $this->getValueByIdentifier('date_of_birth'),
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
            'marktplatz' => [
                'martkplatzfreigabe_am' => $this->show_application_on_marketplace_at,
                'datenfreigabe' => $this->show_test_result_on_marketplace,
                'studiengaengeIds' => $this->selectedCourses(),
                'tags' => [],
                'ort' => $this->getValueByIdentifier('location'),
                'branche' => ApplicantIndustryResource::collection($this->industries()),
                'studienbeginn' => $this->desiredBeginning->course_start_date,
                'motivationschreiben' => $this->marketplace_motivation_text,
                'dokumente' => ApplicantDocumentResource::collection($this->documents),
            ],
            'testergebnisse' => SelectionTestResultResource::collection($this->results),
            'bewerbungen' => ApplicantCompanyResource::collection($this->companies),

            //            'motivation' => ApplicantMotivationResource::collection($this->filterFieldData('motivation')),
        ];
    }

    private function getValueByIdentifier($identifier)
    {
        $fieldValue = $this->user->values->filter(function ($item) use ($identifier) {
            return $item->fields->key == $identifier;
        })->first();
        $value = $fieldValue ? $fieldValue->value : null;
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
                'land' => $this->getValueByIdentifier('country'),
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

    private function selectedCourses()
    {
        return Course::whereIn('id', $this->courses->pluck('course_id'))
            ->pluck('sana_id')->map(function ($id) {
                return ['studiengangId' => $id];
            })->toArray();
    }
}
