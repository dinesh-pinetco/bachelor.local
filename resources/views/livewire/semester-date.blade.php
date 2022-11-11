<div>
    <div class="flex space-x-4">
        <div class="w-full">
            <x-livewire-select key="semester" name="semester" class="flex-grow" id="semester" model="semester">
                <option value="" selected>{{ __('Semester Day') }}</option>
                <option value="1">{{ __('Summer semester') }}</option>
                <option value="2">{{ __('Winter semester') }}</option>
            </x-livewire-select>
        </div>
        <div class="w-full">
            <x-livewire-select key="year" class="flex-grow" name="year" id="year" model="year">
                <option value="" selected>{{ __('Year') }}</option>
                @for ($i = PAST_YEAR; $i <= \Carbon\Carbon::now()->addYears(FUTURE_YEAR)->year; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </x-livewire-select>
        </div>
    </div>
</div>
