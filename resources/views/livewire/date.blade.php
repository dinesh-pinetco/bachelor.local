<div>
    <div class="flex space-x-4">
        @if (!in_array('day', $hiddenFields))
            <div class="w-full">
                <x-livewire-select :isEdit="$isEdit" :key="time() . 'day' . $field->id" name="day" class="flex-grow" id="day" model="day">
                    <option value="" selected>{{ __('Day') }}</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option @if (data_get($date, '2') == $i) selected @endif value="{{ $i }}">
                            {{ $i }}</option>
                    @endfor
                </x-livewire-select>
            </div>
        @endif

        @if (!in_array('month', $hiddenFields))
            <div class="w-full">
                <x-livewire-select :isEdit="$isEdit" :key="time() . 'month' . $field->id" class="flex-grow" name="month" id="month" model="month">
                    <option value="" selected>{{ __('Month') }}</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option @if (data_get($date, '1') == $i) selected @endif value="{{ $i }}">
                            {{ __(Illuminate\Support\Carbon::create()->startOfMonth()->month($i)->startOfMonth()->format('F')) }}
                        </option>
                    @endfor
                </x-livewire-select>
            </div>
        @endif

        @if (!in_array('year', $hiddenFields))
            <div class="w-full">
                <x-livewire-select :isEdit="$isEdit" :key="time() . 'year' . $field->id" class="flex-grow" name="year" id="year" model="year">
                    <option value="" selected>{{ __('Year') }}</option>
                    @for ($i = PAST_YEAR; $i <= \Carbon\Carbon::now()->addYears(FUTURE_YEAR)->year; $i++)
                        <option @if ($i == data_get($date, '0')) selected @endif value="{{ $i }}">
                            {{ $i }}</option>
                    @endfor
                </x-livewire-select>
            </div>
        @endif
    </div>
</div>
