<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum FieldType: string
{
    use InvokableCases;
    use Names;
    use Options;
    use Values;

    case FIELD_TEXT = 'text';
    case FIELD_NUMBER = 'number';
    case FIELD_EMAIL = 'email';
    case FIELD_TEL = 'tel';
    case FIELD_TEXTAREA = 'textarea';
    case FIELD_SELECT = 'select';
    case FIELD_MULTI_SELECT = 'multi_select';
    case FIELD_RADIO = 'radio';
    case FIELD_CHECKBOX = 'checkbox';
    case FIELD_FILE = 'file';
    case FIELD_DATE = 'date';
    case FIELD_MONTH = 'month';
    case FIELD_MONTH_YEAR = 'month_year';
    case FIELD_DATE_PICKER = 'date_picker';
}
