@if (isset($validation_errors) && data_get($validation_errors, 'id_'.$field->id))
    <span class="font-medium text-sm text-red">{{ data_get($validation_errors, 'id_'.$field->id.'.0') }}</span>
@endif
