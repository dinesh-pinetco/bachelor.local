<?php

namespace App\Http\Resources;

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
    public function toArray($request)
    {
        $this->user = $this;

        return [
            'bewerber_id' => $this->id,
            'unternehmenId' => $this->company?->sana_id,
            'ablehnung' => $this->is_rejected,
            'eingestellt_am' => $this->getMeta('enrollment_at'),
            'betreuer_id' => $this->sANNAIdOfEnrollCompanyContact(),
        ];
    }
}
