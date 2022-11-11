<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SannaUserSepaResource extends JsonResource
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
            'kontoinhaber' => $this->account_holder,
            'erteilt' => $this->is_authorize,
            'bic' => $this->withoutSpace($this->swift_code),
            'iban' => $this->withoutSpace($this->iban),
        ];
    }

    private function withoutSpace($value)
    {
        return str_replace(' ', '', $value);
    }
}
