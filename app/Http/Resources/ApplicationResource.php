<?php

namespace App\Http\Resources;

use App\Enums\FieldType;
use App\Models\Field;
use App\Models\Tab;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    use _ApplicantHelper;

    private $user;

    private $mainAddress;

    public function toArray($request): array
    {
        $this->user = $this;

        return [
            'bewerber_id' => $this->id,
            'last_changed' => $this->last_data_updated_at,
            'anonymisiert' => (bool) $this->getValueByIdentifier('is_anonymous'),
            'testlaufBestanden' => $this->hasExamPassed(),
            'bild' => $this->study_sheet?->student_id_card_photo
                ? get_base64_from_local_storage_file($this->study_sheet?->student_id_card_photo)
                : ($this->getValueByIdentifier('avatar')
                    ? get_base64_from_local_storage_file($this->getValueByIdentifier('avatar'))
                    : null),
            'person' => [
                'vorname' => $this->getValueByIdentifier('first_name'),
                'nachname' => $this->getValueByIdentifier('last_name'),
                'akademischer_grad' => $this->getValueByIdentifier('academic_degree'),
                'geburtstag' => $this->getValueByIdentifier('date_of_birth'),
                'geschlecht' => $this->getValueByIdentifier('gender'),
            ],
            'adresse' => $this->getAddress('1'),
            'telefonnummer' => [
                'typ' => 2,
                'telefonnummer' => $this->getValueByIdentifier('phone'),
            ],
            'private_e_mail_adresse' => [
                'typ' => 1,
                'e_mail' => $this->getValueByIdentifier('email'),
            ],
            'marktplatz' => [
                'martkplatzfreigabe_am' => $this->show_application_on_marketplace_at,
                'datenfreigabe' => $this->show_test_result_on_marketplace,
                'studiengaengeIds' => $this->selectedCourses(),
                'tags' => $this->motivationsTags(),
                'ort' => $this->getValueByIdentifier('location'),
                'branche' => ApplicantIndustryResource::collection($this->industries()),
                'studienbeginn' => $this->desiredBeginning->course_start_date,
                'motivationschreiben' => $this->marketplace_motivation_text,
                'dokumente' => ApplicantDocumentResource::collection($this->documents),
            ],
            'testergebnisse' => SelectionTestResultResource::collection($this->show_test_result_on_marketplace ? $this->results : []),
            'bewerbungen' => ApplicantCompanyResource::collection($this->companies),
        ];
    }

    private function motivationsTags()
    {
        $tags = [];

        $this->user->values->whereIn('field_id',
            Field::where('tab_id',
                Tab::where('slug', 'motivation')->value('id')
            )->where('type', FieldType::FIELD_CHECKBOX)
                ->pluck('id'))
            ->each(function ($motivation) use (&$tags) {
                foreach ($this->getValueByIdentifier(data_get($motivation, 'fields.key')) as $value) {
                    $tags[] = [
                        'id' => $value,
                        'kategorie_id' => data_get($motivation, 'fields.key'),
                        'name' => $value,
                    ];
                }
            });

        return $tags;
    }
}
