<?php

namespace App\Http\Resources;

use App\Enums\FieldType;
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

        if (in_array($fieldValue?->fields?->type, [FieldType::FIELD_MULTI_SELECT(), FieldType::FIELD_CHECKBOX()])) {
            return json_decode($value);
        }

        if ($identifier == 'nationality_id') {
            return Nationality::where('id', $value)->value('name');
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
