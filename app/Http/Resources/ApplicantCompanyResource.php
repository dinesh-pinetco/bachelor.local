<?php

namespace App\Http\Resources;

use App\Models\CompanyContacts;
use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $companyContact = CompanyContacts::find($this->user->getValueByField('enroll_company_contact')?->value);

        return [
            'unternehmenId' => $this->company?->sanna_id,
            'datenfreigabe' => $this->created_at,
            'ablehnung' => $this->is_rejected,
            'studiengangId' => Course::findSannaId($this->user->getValueByField('enroll_course')?->value),
            'studienbeginn' => $this->user->desiredBeginning->course_start_date,
            'eingestellt_am' => $this->user->getMeta('enrollment_at'),
            'betreuer_id' => $companyContact->company_id == $this->company_id ? $this->user->getValueByField('enroll_company_contact')?->value : null,
        ];
    }
}
