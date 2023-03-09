<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectionTestResultResource extends JsonResource
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
            'name' => $this->test->name,
            'result' => $this->result,
            'is_passed' => $this->is_passed,
            'result_mix_link' => $this->when($this->is_passed_mix, $this->result_mix_link),
            'result_iqt_link' => $this->when($this->is_passed_iqt, $this->result_iqt_link),
        ];
    }
}
