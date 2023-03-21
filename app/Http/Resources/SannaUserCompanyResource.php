<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class SannaUserCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'unternehmenId' => $this->company?->sanna_id,
            'datenfreigabe' => $this->created_at,
            'ablehnung' => true,
            'studiengangId' => Course::findSannaId($this->user->getValueByField('enroll_course')?->value),
            'studienbeginn' => $this->user->desiredBeginning->course_start_date,
            'eingestellt_am' => $this->user->getMeta('enrollment_at'),
            'betreuer_id' => $this->user->getValueByField('enroll_company_contact')?->value,
        ];
    }
}
