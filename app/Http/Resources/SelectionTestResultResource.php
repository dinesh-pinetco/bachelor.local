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
        $data = [
            'name' => $this->test->name,
            'is_passed' => $this->is_passed,
            'result' => $this->result,
            'zeitVon' => $this->started_at,
            'zeitBis' => $this->completed_at,
        ];

        $data = $this->appendCubiaDetail($data);
        $data = $this->appendMeteoDetail($data);

        return $data;
    }

    private function appendCubiaDetail($data)
    {
        if ($this->isCubiaTest()) {
            $meta_iqt = json_decode($this->meta_iqt);
            $meta_mix = json_decode($this->meta_mix);

            return array_merge($data, [
                'result' => sprintf('%s / %s', data_get($meta_iqt, 3), data_get($meta_mix, 4)),
                'tan' => $this->result,
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
            ]);
        }

        return $data;
    }

    private function appendMeteoDetail(array $data)
    {
        if ($this->isMeteoTest()) {
            $meta = json_decode($this->meta);

            return $data + [
                'typenindikator' => data_get($meta, 'viq-3.full'),
            ];
        }

        return $data;
    }
}
