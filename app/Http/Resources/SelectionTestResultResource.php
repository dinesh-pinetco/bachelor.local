<?php

namespace App\Http\Resources;

use App\Models\Result;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectionTestResultResource extends JsonResource
{
    public static function collection($resource)
    {
        $resource = count($resource) ? $resource->whereNotIn('test_id', [6]) : $resource;

        return tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }

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
            $cubia_mix = $this;
            $cubia_iqt = Result::where('test_id', 6)->where('user_id', $this->user_id)->first();

            $meta_mix = $cubia_mix->meta;
            $meta_iqt = $cubia_iqt?->meta;

            return array_merge($data, [
                'name' => 'Cubia',
                'ergebnis' => sprintf('%s / %s', data_get($meta_mix, 4), data_get($meta_iqt, 3)),
                'tan' => sprintf('%s - %s', data_get($meta_mix, 0), data_get($meta_mix, 1)),
                'ergebnis_mix_link' => $cubia_mix->result,
                'ergebnis_iqt_link' => $cubia_iqt?->result,

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
