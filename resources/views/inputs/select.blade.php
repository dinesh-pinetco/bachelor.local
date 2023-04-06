<ul class="flex flex-wrap items-start">
    @if(!is_null($field->related_option_table))
        @if ($field->related_option_table == 'desired_beginnings')
            <x-livewire-select :isEdit="$isEdit" :name="$field->related_option_table" model="fieldValue"
                               shouldSave="true">
                @foreach($desiredBeginningOptions as $desiredBeginning)
                    <option
                        value="{{ data_get($desiredBeginning,'key') }}">{{ data_get($desiredBeginning,'title') }}</option>
                @endforeach
            </x-livewire-select>
        @elseif ($field->key == 'school_qualification')
            <x-livewire-select :isEdit="$isEdit" :name="$field->related_option_table" model="fieldValue"
                shouldSave="true">
                <option selected value=""> {{ !is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)))}}</option>
                    @foreach($this->getOptionsByModel($field->key) as $option)
                        <option value="{{ $option->id }}"
                            {{ (in_array($option->id, auth()->user()->values->pluck('id')->toArray())) ? "selected":"" }}>
                            {{ __($option->name) }}
                        </option>
                    @endforeach
            </x-livewire-select>
        @else
            <x-livewire-select :isEdit="$isEdit" :name="$field->related_option_table" model="fieldValue"
                               shouldSave="true">
                <option
                    selected value=""> {{ !is_null($field->placeholder)?__($field->placeholder): __('Select') . ' ' . __(ucfirst(str_replace('_', ' ', $field->related_option_table)))}}</option>
                @foreach($this->getOptionsByModel($field->related_option_table) as $option)
                    <option value="{{ $option->id }}"
                        {{ (in_array($option->id, auth()->user()->values->pluck('id')->toArray())) ? "selected":"" }}>
                        {{ __($option->name) }}
                    </option>
                @endforeach
            </x-livewire-select>
        @endif
    @else
        <x-livewire-select :isEdit="$isEdit" :name="$field->related_option_table" model="fieldValue"  shouldSave="true">
            <option selected value=""> {{ __($field->placeholder) }}</option>
            @foreach($field->options as $option)
                <option value="{{ $option->key }}"
                    {{ (in_array($option->id, auth()->user()->values->pluck('id')->toArray())) ? "selected":"" }}>
                    {!! __($option->value) !!}
                </option>
            @endforeach
        </x-livewire-select>
    @endif
</ul>
