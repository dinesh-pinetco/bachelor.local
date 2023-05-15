<?php

namespace App\Http\Resources;

use App\Models\CompanyContacts;
use Illuminate\Http\Resources\Json\JsonResource;

class SannaRejectedUserResource extends JsonResource
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
            'bewerber_id' => $this->user_id,
            'unternehmenId' => $this->company?->sana_id,
            'ablehnung' => (bool) $this->company_rejected_at,
            'eingestellt_am' => $this->company_contacted_at,
            'betreuer_id' => CompanyContacts::where('id', $this->company_contact_id)->value('sana_id'),
        ];
    }
}
