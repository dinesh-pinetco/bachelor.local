<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h3 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ ucfirst($formMode) }} {{ $tab->name }} {{  __('Field') }} </h3>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit">

                        {{-- <livewire:trix :key="time().'1'" :keyId="1" value="one" />
                        <livewire:trix :key="time().'2'" :keyId="2" value="two" /> --}}


                        <div class="space-y-8">

                            <div>
                                <x-jet-label for="group_id" class="block required">{{ __('Group') }}</x-jet-label>
                                <x-livewire-select :isEdit="$isEdit"
                                    class="w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                    id="group_id" name="group_id" model="field.group_id">
                                    <option value=""> {{ __('Select Group') }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->internal_name }}</option>
                                    @endforeach
                                </x-livewire-select>
                                <x-jet-input-error for="field.group_id"/>
                            </div>

                            <div>
                                <x-jet-label for="label" class="block">
                                    {{ __('Label') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="label" :placeholder="__('Label')"
                                             wire:model.defer="field.label" id="label"></x-jet-input>
                                <x-jet-input-error for="field.label"/>
                            </div>
                            <div>
                                <x-jet-label for="placeholder" class="block">
                                    {{ __('Text of Placeholder') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="placeholder" :placeholder="__('Text of Placeholder')"
                                             wire:model.defer="field.placeholder" id="placeholder"></x-jet-input>
                                <x-jet-input-error for="field.placeholder"/>
                            </div>
                            <div>
                                <x-jet-label for="key" class="block">
                                    {{ __('Key') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="key" :placeholder="__('Key')"
                                             wire:model.defer="field.key" id="key"></x-jet-input>
                                <x-jet-input-error for="field.key"/>
                            </div>

                            <div>
                                <x-jet-label for="type" class="block required">{{ __('Type') }}</x-jet-label>
                                <x-livewire-select :isEdit="$isEdit"
                                    class="w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                    id="type" name="type" model="field.type">
                                    <option value=""> {{ __('Select Type') }}</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </x-livewire-select>
                                <x-jet-input-error for="field.type"/>
                            </div>

                            @if ($field->type == App\Enums\FieldType::FIELD_SELECT())
                                <div>
                                    <x-jet-label for="wantToUseTable" class="block">
                                        {{ __('Do you want to use table to set options?') }}
                                    </x-jet-label>
                                    <div class="mt-7">
                                        <input wire:model="wantToUseTable" type="radio" name="wantToUseTableTrue"
                                               value="1" {{ $isEdit ? '' : 'disabled' }}
                                               class="w-5 h-5 form-checkbox text-primary focus:ring-offset-0 focus:outline-none focus:ring-0">
                                        <span class="text-xs ml-0.5">{{ __('Yes') }}</span>
                                        <input wire:model="wantToUseTable" type="radio" name="wantToUseTableFalse"
                                               value="0" {{ $isEdit ? '' : 'disabled' }}
                                               class="w-5 h-5 form-checkbox text-primary focus:ring-offset-0 focus:outline-none focus:ring-0">
                                        <span class="text-xs ml-0.5">{{ __('No') }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($wantToUseTable == 1)
                                <div>
                                    <x-jet-label for="related_option_table" class="block">
                                        {{ __('Table Name') }}</x-jet-label>
                                    <x-livewire-select :isEdit="$isEdit"
                                        class="w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm text-primary placeholder-gray"
                                        id="related_option_table" name="related_option_table"
                                        model="field.related_option_table">
                                        <option value=""> {{ __('Select Table') }}</option>
                                        @foreach (config('application.option_tables') as $table)
                                            <option value="{{ $table }}">
                                                {{ ucfirst(str_replace('_', ' ', $table)) }}</option>
                                        @endforeach
                                    </x-livewire-select>
                                    <x-jet-input-error for="field.related_option_table"/>
                                </div>
                            @endif

                            @if (in_array($field->type, $multiInputTypes) && !$wantToUseTable)
                                @foreach ($options as $key => &$value)
                                    <div class="space-y-7 add-input">
                                        <div>
                                            <x-jet-label for="key{{ $key }}" class="block">
                                                {{ __('Key') }}
                                            </x-jet-label>
                                            <x-jet-input  class="w-full" type="text"
                                                         wire:model="options.{{ $key }}.key"
                                                         :disabled="!$isEdit"
                                                         id="key{{ $key }}">
                                            </x-jet-input>
                                            <x-jet-input-error for="options.{{ $key }}.key"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="value{{ $key }}" class="block">
                                                {{ __('Value') }}
                                            </x-jet-label>
                                             <div wire:ignore>
                                                <trix-editor
                                                    class="prose formatted-content"
                                                    x-data
                                                    x-on:trix-change="$dispatch('input', event.target.value)"
                                                    x-ref="trix"
                                                    wire:model.debounce.500ms="options.{{ $key }}.value"
                                                    wire:key="options.{{ $key }}.value"
                                                ></trix-editor>
                                            </div>
                                            <x-jet-input-error for="options.{{ $key }}.value"/>
                                        </div>
                                        <div class="-mt-0">
                                            @if (sizeof($options) > 1 && $isEdit)
                                                <x-danger-button class="inline-flex"
                                                                 wire:click.prevent="remove({{ $key }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="stroke-current mr-2 text-white h-6 w-6" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M18 12H6"/>
                                                    </svg>
                                                    {{ __('Remove') }}
                                                </x-danger-button>
                                            @endif
                                            @if (sizeof($options) == $key + 1)
                                                <x-primary-button class="inline-flex -mt-0"
                                                                  wire:click.prevent="add({{ $key }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="stroke-current mr-2 text-white h-6 w-6" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    {{ __('Add') }}
                                                </x-primary-button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="flex items-center space-x-2">
                                <input wire:model.defer="field.is_required" type="checkbox" name="is_required"
                                       id="is_required"
                                       value="{{ $field->is_required }}"
                                       class="w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none">
                                <x-jet-input-error for="field.is_required"/>
                                <x-jet-label for="is_required" class="block -mb-0">{{ __('Is required') }}
                                </x-jet-label>
                            </div>

                            <div>
                                <x-jet-label for="status" class="block required">{{ __('Status') }}</x-jet-label>
                                <x-livewire-select
                                    class="w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm text-primary placeholder-gray"
                                    id="status" name="status" model="field.is_active">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('InActive') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="field.is_active"/>
                            </div>

                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit" class="inline-flex">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
