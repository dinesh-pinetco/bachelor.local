<?php

namespace App\Http\Resources;

use App\Services\SelectionTests\Cubia;
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
            'id' => $this->test->id,
            'name' => $this->test->name,
            'ergebnis' => $this->result,
            'bestanden' => $this->is_passed,
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
            $meta_mix = [];
            $meta_iqt = [];
            $ergebnis = null;

            if ($this->course_id == Cubia::MIX) {
                $meta_mix = $this->meta;
                $ergebnis = data_get($meta_mix, 4);
            } else {
                $meta_iqt = $this->meta;
                $ergebnis = data_get($meta_iqt, 3);
            }

            return array_merge($data, [
                'ergebnis' => $ergebnis,
                'tan' => sprintf('%s - %s', data_get($this->meta, 0), data_get($this->meta, 1)),
                'ergebnis_link' => $this->result,

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
            return $data + [
                'typenindikator' => data_get($this->meta, 'viq-3.full'),
            ];
        }

        return $data;
    }
}
