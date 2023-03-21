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

//            TODO:- make it dynamic
            'unternehmenId' => $this->company->sanna_id,
            'datenfreigabe' => true,
            'ablehnung' => true,
            'studiengangId' => 0,
            'studienbeginn' => "2023-10-01T00:00:00.000000Z",
            'eingestellt_am'=> "2023-10-01T00:00:00.000000Z",
            'betreuer_id' => 222,

            'mail_content' => $this->mail_content,
            'hired_at' => $this->hired_at,
        ];
    }
}
