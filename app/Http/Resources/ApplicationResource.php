<?php

namespace App\Http\Resources;

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
            'bild' => 'SSL issue',
//            'bild' => $this->getValueByIdentifier('avatar')
//                ? base64_encode(file_get_contents(route('storage.url', ['path' => $this->getValueByIdentifier('avatar')])))
//                : null,
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
                'tags' => [],
                'ort' => $this->getValueByIdentifier('location'),
                'branche' => ApplicantIndustryResource::collection($this->industries()),
                'studienbeginn' => $this->desiredBeginning->course_start_date,
                'motivationschreiben' => $this->marketplace_motivation_text,
                'dokumente' => ApplicantDocumentResource::collection($this->documents),
            ],
            'testergebnisse' => SelectionTestResultResource::collection($this->show_test_result_on_marketplace ? $this->results : []),
            'bewerbungen' => ApplicantCompanyResource::collection($this->companies),

            //            'motivation' => ApplicantMotivationResource::collection($this->filterFieldData('motivation')),
        ];
    }
}
