<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectionTestResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $meta_iqt = json_decode($this->meta_iqt);
        $meta_mix = json_decode($this->meta_mix);
        return [
            'name' => $this->test->name,
            'tan' => $this->result,
            'is_passed' => $this->is_passed,
            'result_mix_link' => $this->when($this->is_passed_mix, $this->result_mix_link),
            'result_iqt_link' => $this->when($this->is_passed_iqt, $this->result_iqt_link),
            'bindungMix' => data_get($meta_mix, 3),
            'leistungMix' => data_get($meta_mix, 4),
            'machtMix' => data_get($meta_mix, 5),
            'gesamtIqt' => data_get($meta_iqt, 3),
            'spracheIqt' => data_get($meta_iqt, 4),
            'merkfaehigkeitIqt' => data_get($meta_iqt, 5),
            'logikIqt' => data_get($meta_iqt, 6),
            'rechnenIqt' => data_get($meta_iqt, 7),
            'technikIqt' => data_get($meta_iqt, 8),
        ];
    }
}
