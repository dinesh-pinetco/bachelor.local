<x-custom-modal wire:model="showForm" width="w-2/5">
    <x-slot name="title">
        {{ __('Create Desired Beginning') }}
    </x-slot>
    <x-slot name="slot">
        <div class="bg-white sm:rounded-lg">
            <div class="px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-lightgray">
                    <div class=" pb-4 sm:pb-3">
                        <dt class="text-sm font-medium text-gray-500 block mb-4">{{ __('Desire Beginning') }}</dt>
                        <div class="flex items-center justify-between gap-4">
                            <select
                                class="capitalize md:w-1/2 w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                id="type" name="type"
                                wire:model="month"
                            >
                                <option value=""> {{ __('Select Type') }}</option>
                                <option value="01">{{ __('January') }}</option>
                                <option value="02">{{ __('February') }}</option>
                                <option value="03">{{ __('March') }}</option>
                                <option value="04">{{ __('April') }}</option>
                                <option value="05">{{ __('May') }}</option>
                                <option value="06">{{ __('June') }}</option>
                                <option value="07">{{ __('July') }}</option>
                                <option value="08">{{ __('August') }}</option>
                                <option value="09">{{ __('September') }}</option>
                                <option value="10">{{ __('October') }}</option>
                                <option value="11">{{ __('November') }}</option>
                                <option value="12">{{ __('December') }}</option>
                            </select>
                            <select
                                class="col-span-2 cursor-pointer md:w-1/2 w-full px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                id="type"
                                name="type"
                                wire:model.debounce.500ms="year"
                            >
                                <option value=""> {{ __('Select Year') }}</option>
                                @for($i= now()->format('Y'); $i<=2050; $i++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <x-jet-input-error for="course_start_date" class="mt-1"/>
                </dl>
                <dl class="sm:divide-y sm:divide-lightgray">
                    <div class="pb-4 sm:pb-3">
                        <dt class="text-sm font-medium text-gray-500 block mb-4">{{ __('Status') }}</dt>
                        <div class="flex items-center justify-start gap-4">
                            <div class="flex space-x-2 items-center">
                                <input wire:model="archive_at"
                                       type="radio"
                                       value="1"
                                       id="only_text"
                                       class="w-5 h-5 form-checkbox text-primary focus:ring-offset-0 focus:outline-none focus:ring-0 hover:cursor  cursor-pointer">
                                <label class="text-xs ml-0.5 -mb-0 cursor-pointer"
                                       for="only_text">{{ __('Active') }}</label>
                            </div>
                            <div class="flex space-x-2 items-center">
                                <input wire:model="archive_at"
                                       type="radio"
                                       value="0"
                                       id="in_active"
                                       class="w-5 h-5 form-checkbox text-primary focus:ring-offset-0 focus:outline-none focus:ring-0 hover:cursor  cursor-pointer">
                                <label class="text-xs ml-0.5 -mb-0 cursor-pointer"
                                       for="in_active">{{ __('InActive') }}</label>
                            </div>
                        </div>
                    </div>
                    <x-jet-input-error for="archive_at" class="mt-1"/>
                </dl>
                <div>
                    <x-jet-input-error for="document.is_active"/>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex justify-end space-x-2">
            @if($isEdit)
                <x-primary-button type="button"
                                   wire:click="update"
                                  class="flex md:-mt-0 cursor-pointer">
                    {{ __('Update') }}
                </x-primary-button>
            @else
                <x-primary-button type="button"
                                  wire:click="save"
                                  class="flex md:-mt-0 cursor-pointer">
                            {{ __('Save') }}
                </x-primary-button>
            @endif
            <x-danger-button data-cy="delete-button" wire:click="$set('show', false)">
                {{ __('Cancel') }}
            </x-danger-button>
        </div>
    </x-slot>
</x-custom-modal>
