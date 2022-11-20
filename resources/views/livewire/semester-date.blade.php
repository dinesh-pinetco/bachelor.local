<div>
    <div class="flex space-x-4">
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
