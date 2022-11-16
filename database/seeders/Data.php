<?php

namespace Database\Seeders;

use App\Enums\FieldType;
use App\Models\Field;

class Data
{
    public static function getTabTableData()
    {
        $data = [
            [
                'name' => 'Profil',
                'description' => 'Persönliche Informationen',
                'slug' => 'profile',
                'icon' => 'profile',
                'sort_order' => 1,
                'meta_data' => [
                    'button_text' => 'speichern',
                ],
                'groups' => [
                    [
                        'internal_name' => __('Personal Information'),
                        'title' => '',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_FILE->value,
                                'label' => 'Bewerbungsfoto',
                                'placeholder' => 'Wählen Sie eine Datei',
                                'key' => 'avatar',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Geschlecht',
                                'placeholder' => 'Geschlecht auswählen',
                                'key' => 'gender',
                                'sort_order' => 2,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [
                                    [
                                        'key' => 'male',
                                        'value' => 'Männlich',
                                    ],
                                    [
                                        'key' => 'female',
                                        'value' => 'Weiblich',
                                    ],
                                    [
                                        'key' => 'other',
                                        'value' => 'Divers',
                                    ],
                                ],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Vorname',
                                'key' => 'first_name',
                                'placeholder' => 'Nachnamen eingeben',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Nachname',
                                'key' => 'last_name',
                                'placeholder' => 'Nachnamen eingeben',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Akademischer Grad/Titel',
                                'placeholder' => 'Akademischer Grad/Titel auswählen',
                                'key' => 'academic_degree',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [
                                    [
                                        'key' => 'Bachelor',
                                        'value' => 'Bachelor',
                                    ],
                                    [
                                        'key' => 'Master',
                                        'value' => 'Master',
                                    ],
                                    [
                                        'key' => 'Doktor',
                                        'value' => 'Doktor',
                                    ],
                                ],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_DATE->value,
                                'label' => 'Geburtsdatum',
                                'placeholder' => '',
                                'key' => 'date_of_birth',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Geburtsort',
                                'placeholder' => 'Geburtsort eingeben',
                                'key' => 'place_of_birth',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            // [
                            //     'type'        => FieldType::FIELD_TEXT->value,
                            //     'label'       => 'Geburtsland',
                            //     'placeholder' => 'Geburtsland eingeben',
                            //     'sort_order'  => 1,
                            //     'is_active'   => 1,
                            //     'is_required'   => 1,
                            //     'meta_data'   => [],
                            // ],
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Geburtsland',
                                'key' => 'nationality_id',
                                'placeholder' => 'Geburtsland eingeben',
                                'related_option_table' => 'nationalities',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Staatsbürgerschaft (Staat)',
                                'key' => 'citizenship_id',
                                'placeholder' => 'Staatsangehörigkeit eingeben (Staat)',
                                'related_option_table' => 'nationalities',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                        ],
                    ],
                    [
                        'internal_name' => __('Application for the'),
                        'title' => 'Bewerbung für',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Gewünschter Studiengang',
                                'key' => 'course_id',
                                'placeholder' => 'Gewünschten Studiengang auswählen',
                                'sort_order' => 1,
                                'related_option_table' => 'courses',
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Zum gewünschten Studienbeginn',
                                'key' => 'desired_beginning_id',
                                'placeholder' => 'Wählen Sie Gewünschter Studienbeginn',
                                'sort_order' => 2,
                                'related_option_table' => 'desired_beginnings',
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                        ],
                    ],
                    [
                        'internal_name' => __('Contact Details'),
                        'title' => 'Kontaktdetails',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Straße/Hausnummer',
                                'placeholder' => 'Straße und Hausnummer eingeben',
                                'key' => 'street_house_number',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Postleitzahl',
                                'placeholder' => 'Postleitzahl eingeben',
                                'key' => 'postal_code',
                                'sort_order' => 2,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT->value,
                                'label' => 'Standort',
                                'placeholder' => 'Ort eingeben',
                                'key' => 'location',
                                'sort_order' => 3,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEL->value,
                                'label' => 'Telefon',
                                'placeholder' => 'Telefon eingeben',
                                'key' => 'phone',
                                'sort_order' => 4,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_EMAIL->value,
                                'label' => 'E-Mail Adresse',
                                'placeholder' => 'E-Mail Adresse eingeben',
                                'key' => 'email',
                                'sort_order' => 5,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_CHECKBOX->value,
                                'label' => '',
                                'placeholder' => null,
                                'key' => 'privacy_policy',
                                'sort_order' => 6,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                                'options' => [
                                    [
                                        'key' => '1',
                                        'value' => '<div>Ich habe die Datenschutzbestimmungen <a href="https://www.nordakademie.de/datenschutz" class="underline text-blue-600">gelesen</a> und ich bin damit einverstanden.</div>',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Industry',
                'description' => 'Industry Description',
                'slug' => 'industries',
                'icon' => 'industry',
                'sort_order' => 2,
                'meta_data' => [
                    'button_text' => 'Speichern und weiter',
                ],
                'groups' => [
                    [
                        'internal_name' => 'Un 1',
                        'title' => '',
                        'description' => '<p>Bitte geben Sie einen kurzen Überblick über Ihre berufliche Laufbahn. Bitte beginnen Sie mit Ihrer gegenwärtigen Position. Bei Bedarf fügen Sie bitte weitere Zeilen ein.</p> <p> Wenn bei Ende kein Zeitpunkt eingegeben wird, wird angenommen, dass Sie die Stelle zur Zeit ausüben</p> <p><b>Sollten Sie bisher keine Arbeit ausgeübt haben, schreiben Sie bitte als Arbeitgeber “keinen” und lassen den Zeitraum offen.</b></p>',
                        'can_add_more' => false,
                        'add_more_label' => 'weiteren Arbeitgeber hinzufügen',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_SELECT->value,
                                'label' => 'Industry',
                                'placeholder' => 'Select Industry',
                                'key' => 'industry',
                                'sort_order' => 2,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [
                                    [
                                        'key' => 'nader_group',
                                        'value' => 'Nader Group',
                                    ],
                                    [
                                        'key' => 'zemlak_hills',
                                        'value' => 'Zemlak-Hills',
                                    ],
                                    [
                                        'key' => 'hamill_vandervort',
                                        'value' => 'Hamill-Vandervort',
                                    ],
                                    [
                                        'key' => 'stiedemann_lehner',
                                        'value' => 'Stiedemann-Lehner',
                                    ],
                                    [
                                        'key' => 'collier_roob_and_hudson',
                                        'value' => 'Collier, Roob and Hudsont',
                                    ],
                                ],
                                'meta_data' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Motivation',
                'description' => 'Erzählen Sie etwas über sich',
                'slug' => 'motivation',
                'icon' => 'motivation',
                'sort_order' => 3,
                'meta_data' => [
                    'button_text' => 'Speichern und weiter',
                ],
                'groups' => [
                    [
                        'internal_name' => 'Motivations',
                        'title' => '',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_TEXTAREA->value,
                                'label' => 'Bitte begründen Sie Ihren Studienwunsch.',
                                'placeholder' => '',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXTAREA->value,
                                'label' => 'Welche Erwartungen haben Sie an das Studium (Inhalte, Studienmotivation, Berufsplanung, zeitlicher und finanzieller Aufwand)?',
                                'placeholder' => '',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXTAREA->value,
                                'label' => 'Unterstützt Ihr Arbeitgeber Sie zeitlich und/oder finanziell?',
                                'placeholder' => '',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return collect($data);
    }
}
