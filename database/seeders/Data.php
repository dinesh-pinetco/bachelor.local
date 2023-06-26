<?php

namespace Database\Seeders;

use App\Enums\FieldType;

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
                'is_progress_countable' => true,
                'meta_data' => [
                    'button_text' => 'speichern',
                ],
                'groups' => [
                    [
                        'internal_name' => __('Application for the'),
                        'title' => 'Bewerbung für',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_SELECT(),
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
                            [
                                'type' => FieldType::FIELD_MULTI_SELECT(),
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

                        ],
                    ],
                    [
                        'internal_name' => __('Personal Information'),
                        'title' => '',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_FILE(),
                                'label' => 'Bewerbungsfoto',
                                'placeholder' => 'Wählen Sie eine Datei',
                                'key' => 'avatar',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 0,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT(),
                                'label' => 'Anrede',
                                'placeholder' => 'Bitte wählen',
                                'key' => 'gender',
                                'sort_order' => 2,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [
                                    [
                                        'key' => 1,
                                        'value' => 'Herr',
                                    ],
                                    [
                                        'key' => 3,
                                        'value' => 'divers',
                                    ],
                                    [
                                        'key' => 2,
                                        'value' => 'Frau',
                                    ],
                                ],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Vorname',
                                'key' => 'first_name',
                                'placeholder' => 'Nachnamen eingeben',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                                'validation' => VALIDATION_ALPHA,
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Nachname',
                                'key' => 'last_name',
                                'placeholder' => 'Nachnamen eingeben',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                                'validation' => VALIDATION_ALPHA,
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Strasse und Hausnummer',
                                'key' => 'street_house_number',
                                'placeholder' => 'Strasse und Hausnummer',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                                'validation' => VALIDATION_ALPHA_NUMBERS,
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'PLZ',
                                'key' => 'postal_code',
                                'placeholder' => 'PLZ',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Ort',
                                'key' => 'location',
                                'placeholder' => 'Ort',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Land',
                                'key' => 'country',
                                'placeholder' => 'Land',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_EMAIL(),
                                'label' => 'E-Mail Adresse',
                                'placeholder' => 'E-Mail Adresse eingeben',
                                'key' => 'email',
                                'sort_order' => 5,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_TEL(),
                                'label' => 'Telefon',
                                'placeholder' => 'Telefon',
                                'key' => 'phone',
                                'sort_order' => 5,
                                'is_active' => 1,
                                'is_required' => 0,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_DATE(),
                                'label' => 'Geburtsdatum',
                                'placeholder' => '',
                                'key' => 'date_of_birth',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_SELECT(),
                                'label' => 'Wie bist Du auf die NORDAKADEMIE aufmerksam geworden?',
                                'placeholder' => 'Bitte wählen',
                                'key' => 'find_from',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => false,
                                'options' => [
                                    ['value' => 'Kollegen/Firma', 'key' => 1],
                                    ['value' => 'Freunde/Bekannte/Familie', 'key' => 2],
                                    ['value' => 'Aktueller Student/Alumni', 'key' => 3],
                                    ['value' => 'Suchmaschine', 'key' => 4],
                                    ['value' => 'Studienplatzbörse', 'key' => 5],
                                    ['value' => 'Werbung', 'key' => 6],
                                    ['value' => 'Social Media', 'key' => 7],
                                    ['value' => 'Presseartikel', 'key' => 8],
                                    ['value' => 'Zeitungsanzeige', 'key' => 9],
                                    ['value' => 'Plakat', 'key' => 10],
                                    ['value' => 'Infoveranstaltung in der Schule', 'key' => 11],
                                    ['value' => 'Karriereabend', 'key' => 12],
                                    ['value' => 'Tag der offenen Tür', 'key' => 13],
                                    ['value' => 'Messe', 'key' => 14],
                                    ['value' => 'Sonstige Veranstaltung', 'key' => 15],
                                    ['value' => 'Sonstiges', 'key' => 16],
                                ],
                                'meta_data' => [
                                    'text' => 'Es ist das jahr einzugeben in dem das Stadium aufgenommen werdensoll, also aktuell 2023.',
                                ],
                            ],

                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Wie genau? / Durch wen?',
                                'placeholder' => 'Wie genau? / Durch wen?',
                                'key' => 'find_by_whom',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => false,
                                'options' => [],
                                'meta_data' => [
                                    'text' => 'Es ist das jahr einzugeben in dem das Stadium aufgenommen werdensoll, also aktuell 2023.',
                                ],
                            ],

                            [
                                'type' => FieldType::FIELD_SELECT(),
                                'label' => 'In welcher Stadt ist die Schule, in der du die Hochschulberechtigung erwerben wirst oder erworben hast?',
                                'placeholder' => 'Bitte wählen',
                                'key' => 'city',
                                'related_option_table' => 'cities',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => false,
                                'options' => [],
                            ],

                            [
                                'type' => FieldType::FIELD_SELECT(),
                                'label' => 'An welcher Schule wirst/hast Du deine Hochschulzugangsberechtigung erworben?',
                                'placeholder' => 'Bitte wählen',
                                'key' => 'school_qualification',
                                'related_option_table' => 'schools',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => false,
                                'options' => [],
                                'meta_data' => [
                                    'text' => 'Es ist das jahr einzugeben in dem das Stadium aufgenommen werdensoll, also aktuell 2023.',
                                ],
                            ],
                            [
                                'type' => FieldType::FIELD_TEXT(),
                                'label' => 'Falls Deine Schule nicht in der Liste vorkommt, nenne diese bitte hier mit Namen, PLZ und Ort',
                                'placeholder' => 'Falls Deine Schule nicht in der Liste vorkommt, nenne diese bitte hier mit Namen, PLZ und Ort',
                                'key' => 'not_listed_school_name',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => false,
                                'options' => [],
                                'meta_data' => [
                                    'text' => 'Es ist das jahr einzugeben in dem das Stadium aufgenommen werdensoll, also aktuell 2023.',
                                ],
                            ],
                            [
                                'type' => FieldType::FIELD_CHECKBOX(),
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
                                        'value' => 'Ich habe die Datenschutzerklärung gelesen und akzeptiert.',
                                    ],
                                ],
                            ],
                            [
                                'type' => FieldType::FIELD_CHECKBOX(),
                                'label' => '',
                                'placeholder' => null,
                                'key' => 'terms_and_condition',
                                'sort_order' => 6,
                                'is_active' => 1,
                                'is_required' => 0,
                                'meta_data' => [],
                                'options' => [
                                    [
                                        'key' => '1',
                                        'value' => 'Hiermit stimme Ich zu, dass die in den Fragebögen und Testverfahren erhobenen Daten neben der Auswertung hinsichtlich Eignung und Passung zu der von mir gewählten Studienrichtung ebenfalls hinsichtlich Eignung und Passung zu weiteren an der NORDAKADEMIE angebotenen Studienrichtungen ausgewertet werden dürfen. (Zusatz zur Datenschutzerklärung)',
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
                'is_progress_countable' => true,
                'meta_data' => [
                    'button_text' => 'Speichern und weiter',
                ],
                'groups' => [
                    [
                        'internal_name' => 'Un 1',
                        'title' => '',
                        'description' => '<div>Liebe:r Bewerber:in, hier kannst du deine Daten vervollständigen und so dein gesamtes Profil für ausgewählte und / oder alle Partnerunternehmen der NORDAKADEMIE sichtbar machen.</div><div><strong>Dein Vorteil:</strong> Viele Unternehmen suchen händeringend nach dualen Student:innen und kommen vielleicht sogar direkt auf dich zu - cool, oder?</div><div>Dennoch ist es wichtig, dass du dich bei deinen Wunschunternehmen nochmals direkt über deren Karriere-Portal bewirbst!!</div><div>Wir wünschen dir viel Erfolg und freuen uns, dich bald an der NORDAKADEMIE begrüßen zu dürfen :-)</div><div><br></div>',
                        'can_add_more' => false,
                        'add_more_label' => 'weiteren Arbeitgeber hinzufügen',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_MULTI_SELECT(),
                                'label' => __('Industry'),
                                'placeholder' => __('Select Industry'),
                                'key' => 'industry',
                                'sort_order' => 2,
                                'related_option_table' => 'industries',
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => __('Motivation'),
                'description' => 'Tell me something about you.',
                'slug' => 'motivation',
                'icon' => 'motivation',
                'title' => 'Motivation',
                'sort_order' => 3,
                'is_progress_countable' => true,
                'meta_data' => [
                    'button_text' => 'Speichern und weiter',
                ],
                'groups' => [
                    [
                        'internal_name' => 'Motivations',
                        'title' => 'Motivation',
                        'description' => '',
                        'fields' => [
                            [
                                'type' => FieldType::FIELD_TEXTAREA(),
                                'label' => 'Bitte erläutere kurz, warum du dich für ein duales Studium interessierst, was dich ausmacht und was deinen zukünftigen Arbeitgeber ausmachen sollte:',
                                'key' => 'reasons_to_study',
                                'placeholder' => '',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'options' => [],
                                'meta_data' => [],
                            ],
                            [
                                'type' => FieldType::FIELD_CHECKBOX(),
                                'label' => 'Bitte markiere max. 10 Eigenschaften, die am deutlichsten auf dich zutreffen: *',
                                'key' => 'characteristics',
                                'placeholder' => '',
                                'sort_order' => 1,
                                'is_active' => 1,
                                'is_required' => 1,
                                'meta_data' => [],
                                'options' => [
                                    [
                                        'key' => 'analytisch',
                                        'value' => 'analytisch',
                                    ],
                                    [
                                        'key' => 'belastbar',
                                        'value' => 'belastbar',
                                    ],
                                    [
                                        'key' => 'durchsetzungsfähig',
                                        'value' => 'durchsetzungsfähig',
                                    ],
                                    [
                                        'key' => 'ehrlich',
                                        'value' => 'ehrlich',
                                    ],
                                    [
                                        'key' => 'empathisch',
                                        'value' => 'empathisch',
                                    ],
                                    [
                                        'key' => 'fair',
                                        'value' => 'fair',
                                    ],
                                    [
                                        'key' => 'flexibel',
                                        'value' => 'flexibel',
                                    ],
                                    [
                                        'key' => 'geduldig',
                                        'value' => 'geduldig',
                                    ],
                                    [
                                        'key' => 'gewissenhaft',
                                        'value' => 'gewissenhaft',
                                    ],
                                    [
                                        'key' => 'hilfsbereit',
                                        'value' => 'hilfsbereit',
                                    ],
                                    [
                                        'key' => 'innovativ',
                                        'value' => 'innovativ',
                                    ],
                                    [
                                        'key' => 'kommunikativ',
                                        'value' => 'kommunikativ',
                                    ],
                                    [
                                        'key' => 'konfliktfähig',
                                        'value' => 'konfliktfähig',
                                    ],
                                    [
                                        'key' => 'kreativ',
                                        'value' => 'kreativ',
                                    ],
                                    [
                                        'key' => 'leistungsbereit',
                                        'value' => 'leistungsbereit',
                                    ],
                                    [
                                        'key' => 'lernbereit',
                                        'value' => 'lernbereit',
                                    ],
                                    [
                                        'key' => 'loyal',
                                        'value' => 'loyal',
                                    ],
                                    [
                                        'key' => 'mobil',
                                        'value' => 'mobil',
                                    ],
                                    [
                                        'key' => 'motiviert',
                                        'value' => 'motiviert',
                                    ],
                                    [
                                        'key' => 'offen',
                                        'value' => 'offen',
                                    ],
                                    [
                                        'key' => 'optimistisch',
                                        'value' => 'optimistisch',
                                    ],
                                    [
                                        'key' => 'organisiert',
                                        'value' => 'organisiert',
                                    ],
                                    [
                                        'key' => 'proaktiv',
                                        'value' => 'proaktiv',
                                    ],
                                    [
                                        'key' => 'resilient / widerstandsfähig',
                                        'value' => 'resilient / widerstandsfähig',
                                    ],
                                    [
                                        'key' => 'selbstbewusst',
                                        'value' => 'selbstbewusst',
                                    ],
                                    [
                                        'key' => 'selbststandig',
                                        'value' => 'selbststandig',
                                    ],
                                    [
                                        'key' => 'sorgfältig',
                                        'value' => 'sorgfältig',
                                    ],
                                    [
                                        'key' => 'sozial',
                                        'value' => 'sozial',
                                    ],
                                    [
                                        'key' => 'sportlich',
                                        'value' => 'sportlich',
                                    ],
                                    [
                                        'key' => 'stabil',
                                        'value' => 'stabil',
                                    ],
                                    [
                                        'key' => 'strukturiert',
                                        'value' => 'strukturiert',
                                    ],
                                    [
                                        'key' => 'teamfähig',
                                        'value' => 'teamfähig',
                                    ],
                                    [
                                        'key' => 'unternehmerisch',
                                        'value' => 'unternehmerisch',
                                    ],
                                    [
                                        'key' => 'verantwortungsbewusst',
                                        'value' => 'verantwortungsbewusst',
                                    ],
                                    [
                                        'key' => 'zielstrebig',
                                        'value' => 'zielstrebig',
                                    ],
                                    [
                                        'key' => 'zuverlassig',
                                        'value' => 'zuverlassig',
                                    ],
                                    [
                                        'key' => 'zuversichtlich',
                                        'value' => 'zuversichtlich',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return collect($data);
    }
}
