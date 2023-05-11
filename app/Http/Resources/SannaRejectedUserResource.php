<?php

namespace App\Http\Resources;

use App\Models\CompanyContacts;
use Illuminate\Http\Resources\Json\JsonResource;

class SannaRejectedUserResource extends JsonResource
{
    use _ApplicantHelper;

    private $user;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    //TODO:
    public function toArray($request)
    {
        $applicantCompany = $this->load('user');

        $fieldValue = $applicantCompany->user->values->filter(function ($item) {
            return $item->fields->key == 'enroll_company_contact';
        })->first();
        $value = $fieldValue ? $fieldValue->value : null;

        return [
            'bewerber_id' => $this->user_id,
            'unternehmenId' => $this->company?->sana_id,
            'ablehnung' => (bool)$this->company_rejected_at,
            'eingestellt_am' => $this->company_hired_at,
            'betreuer_id' => CompanyContacts::where('id', $value)->value('sana_id'),
        ];
    }
}
