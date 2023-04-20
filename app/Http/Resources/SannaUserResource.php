<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SannaUserResource extends JsonResource
{
    use _ApplicantHelper;

    private $user;

    private $mainAddress;

    public function toArray($request): array
    {
        $this->user = $this;

        return [
            'person' => [
                'bewerber_id' => $this->id,
                'vorname' => $this->getValueByIdentifier('first_name'),
                'nachname' => $this->getValueByIdentifier('last_name'),
                'akademischer_grad' => $this->getValueByIdentifier('academic_degree'),
                'geburtstag' => $this->getValueByIdentifier('date_of_birth'),
                'geburtsort' => $this->getValueByIdentifier('place_of_birth'),
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
            'daten_statistisches_landesamt' => ! $this->government_form ? [] : [
                'staatsangehoerigkeit_1' => $this->getValue($this->government_form->country),
                'staatsangehoerigkeit_2' => $this->getValue($this->government_form->second_country),

                'heimatwohnsitz_bundesland' => $this->getValue($this->government_form->previous_residence_state),
                'heimatwohnsitz_kreis' => $this->getValue($this->government_form->previous_residence_district),
                'heimatwohnsitz_staat' => $this->getValue($this->government_form->previous_residence_country),

                'hochschulzugangsberechtigung_jahr' => $this->government_form->graduation_year,
                'hochschulzugangsberechtigung_monat' => $this->government_form->graduation_month,
                'art_der_hochschulzugangsberechtigung' => $this->getValue($this->government_form->graduation_entrance_qualification),
                'hochschulzugangsberechtigung_bundesland' => $this->getValue($this->government_form->graduation_state),
                'hochschulzugangsberechtigung_kreis' => $this->getValue($this->government_form->graduation_district),
                'hochschulzugangsberechtigung_staat' => $this->getValue($this->government_form->graduation_country),

                'semesterwohnsitz_bundesland' => $this->getValue($this->government_form->current_residence_state),
                'semesterwohnsitz_kreis' => $this->getValue($this->government_form->current_residence_district),
                'semesterwohnsitz_staat' => $this->getValue($this->government_form->current_residence_country),
                'ersteinschreibung_hochschule' => $this->getValue($this->government_form->enrollment_university),
                'ersteinschreibung_staat' => $this->getValue($this->government_form->enrollment_country),
                'ersteinschreibung_sonstige_hochschule' => $this->government_form->enrollment_course,
                'ersteinschreibung_semester' => $this->government_form->enrollment_semester_id,
                'ersteinschreibung_summe_semester' => $this->government_form->enrollment_total_semester,
                'ersteinschreibung_jahr' => $this->government_form->enrollment_year,

                'abgeschlossene_berufsausbildung' => filter_var($this->government_form->is_vocational_training_completed, FILTER_VALIDATE_BOOLEAN),

                'im_letzten_semester_studiert' => filter_var($this->government_form->is_previous_another_university, FILTER_VALIDATE_BOOLEAN),
                'vorheriges_semester_studiert_hochschule' => $this->getValue($this->government_form->previous_college),
                'vorheriges_semester_studiert_staat' => $this->getValue($this->government_form->previous_college_country),
                'vorheriges_semester_studiert_angestrebte_pruefung' => $this->getValue($this->government_form->previous_final_exam),
                'vorheriges_semester_studiert_angestrebte_abschluss' => $this->government_form->previous_study_type_id,
                'vorheriges_semester_studiert_studiengang' => [
                    'vorheriges_semester_studiert_studiengang_1' => $this->government_form->previous_course_id,
                    'vorheriges_semester_studiert_studiengang_2' => $this->government_form->previous_second_course_id,
                    'vorheriges_semester_studiert_studiengang_3' => $this->government_form->previous_third_course_id,
                ],
                'abgeschlossene_pruefung' => $this->getValue($this->government_form->last_exam),
                'abgeschlossener_abschluss' => $this->government_form->last_study_type_id,
                'vorheriger_abschluss_hochschule' => $this->getValue($this->government_form->last_exam_university),
                'vorheriger_abschluss_staat' => $this->getValue($this->government_form->previous_college_country),
                'vorheriger_abschluss_jahr' => $this->government_form->last_exam_year,
                'vorheriger_abschluss_monat' => $this->government_form->last_exam_month,
                'vorheriger_abschluss_studiengang' => [
                    'vorheriges_abschluss_studiengang_1' => $this->government_form->last_exam_course_id,
                    'vorheriges_abschluss_studiengang_2' => $this->government_form->last_exam_second_course_id,
                    'vorheriges_abschluss_studiengang_3' => $this->government_form->last_exam_third_course_id,
                ],
                'vorheriger_abschluss_pruefung_bestanden' => filter_var($this->government_form->is_last_exam_pass, FILTER_VALIDATE_BOOLEAN),
                'vorheriger_abschluss_pruefung_note' => $this->government_form->last_exam_grade,
            ],
            'vertrag_verschickt_am' => $this->contract?->send_date,
            'vertrag_zurueck_am' => $this->contract?->receive_date,
            'studienbeginn' => $this->desiredBeginning->course_start_date,
            'bild' => $this->study_sheet?->student_id_card_photo
                ? get_base64_from_local_storage_file($this->study_sheet?->student_id_card_photo)
                : ($this->getValueByIdentifier('avatar')
                    ? get_base64_from_local_storage_file($this->getValueByIdentifier('avatar'))
                    : null),
            'datenschutzerklaerung' => filter_var($this->getValueByIdentifier('privacy_policy'), FILTER_VALIDATE_BOOLEAN),
            'datenschutzerklaerung_alumni' => filter_var($this->getValueByIdentifier('terms_and_condition'), FILTER_VALIDATE_BOOLEAN),
            'geburtsland' => $this->getValueByIdentifier('nationality_id'),
            'studiengangId' => $this->courses()->first()->course->sana_id,
            'krankenversicherung' => [
                'art_der_krankenversicherung' => $this->study_sheet?->health_insurance_type == '1' ? 'gesetzlich' : 'privat',
                'krankenversichertennummer' => $this->study_sheet?->health_insurance_number,
                'krankenversicherung' => $this->study_sheet?->health_insurance_companies?->sana_id,
            ],
            'firmaId' => $this->sANNAIdOfEnrollCompany(),
            'betreuerId' => $this->sANNAIdOfEnrollCompanyContact(),
            'fremdsprache' => $this->study_sheet?->secondary_language,

        ];
    }
}
