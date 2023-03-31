<?php

namespace App\Http\Resources;

use App\Models\Company;
use App\Models\CompanyContacts;
use App\Models\Course;
use App\Models\Field;
use App\Models\Nationality;
use App\Models\Tab;

trait _ApplicantHelper
{
    public function getValueByIdentifier($identifier)
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
                'mr' => 1,
                'ms' => 2,
                'mrs' => 3,
            ];

            return data_get($genders, $value);
        }

        return $value;
    }

    public function getAddress($type): array
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

    public function getValue($object)
    {
        $key = 'sana_id';

        return $object != null ? $object->{$key} : null;
    }

    public function filterFieldData(string $string)
    {
        return collect($this->user->values)
            ->whereIn('field_id', Field::where('tab_id', Tab::where('slug', $string)->value('id'))->pluck('id'))
            ->values();
    }

    public function selectedCourses()
    {
        return Course::whereIn('id', $this->user->courses->pluck('course_id'))
            ->pluck('sana_id')->map(function ($id) {
                return ['studiengangId' => $id];
            })->toArray();
    }

    public function sANNAIdOfEnrollCompany()
    {
        return Company::where('id', $this->getValueByIdentifier('enroll_company'))->value('sana_id');
    }

    public function sANNAIdOfEnrollCompanyContact()
    {
        return CompanyContacts::where('id', $this->getValueByIdentifier('enroll_company_contact'))->value('sana_id');
    }
}
