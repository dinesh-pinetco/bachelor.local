<?php

namespace App\Http\Resources;

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
            'company_id' => $this->company->sanna_id,
            'mail_content' => $this->mail_content,
            'hired_at' => $this->hired_at,
        ];
    }
}
