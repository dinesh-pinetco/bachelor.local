<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('Document') }}</h2>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="documentForm">
                        <div class="space-y-7 overflow-y-auto px-4 -mx-4">
                            <div>
                                <x-jet-label for="name" class="block required">{{ __('Name') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="name" :placeholder="__('Name')"
                                             wire:model.defer="document.name" id="name"></x-jet-input>
                                <x-jet-input-error for="document.name"/>
                            </div>

                            <div>
                                <x-jet-label for="placeholder" class="block">
                                    {{ __('Description') }}
                                </x-jet-label>
                                <textarea id="description" name="description"
                                          wire:model.defer="document.description"
                                          placeholder="{{__('Description')}}"
                                          rows="3"
                                          class="w-full border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-primary placeholder-gray shadow-sm">
                                </textarea>
                                <x-jet-input-error for="document.description"/>
                            </div>
                            <div>
                                <x-jet-label for="extensions" class="block">
                                    {{ __('File formats') }}
                                </x-jet-label>
                                <x-multi-select
                                    id="extensions"
                                    :key="time() . 'selectedExtensions'"
                                    wire:model="selectedExtensions"
                                    :value="$selectedExtensions"
                                    :placeholder="__('Select extensions')"
                                    :options='$extensions'
                                    keyBy="id"
                                    label-by="name"/>
                                <x-jet-input-error for="extensions"/>
                            </div>
                            <div>
                                <x-jet-label for="is_required" class="block required">{{ __('Required') }}
                                </x-jet-label>
                                <x-livewire-select id="is_required" name="is_required" model="document.is_required"
                                                   class="w-full">
                                    <option value="">{{ __('Please select') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="document.is_required"/>
                            </div>
                            <div>
                                <x-jet-label for="is_active" class="block required">{{ __('Status') }}</x-jet-label>
                                <x-livewire-select
                                    id="is_active"
                                    name="is_active"
                                    model="document.is_active"
                                    class="w-full">
                                    <option value="">{{ __('Please select') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('InActive') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="document.is_active"/>
                            </div>

                            <div>
                                <x-jet-label for="courses" class="block">{{ __('Assign Course') }}
                                </x-jet-label>
                                <x-multi-select
                                    id="courses"
                                    :key="time() . 'courses'"
                                    wire:model="course_ids"
                                    :value="$course_ids"
                                    :placeholder="__('Select course')"
                                    :options='$courses'
                                    key-by="id"
                                    label-by="name"
                                />
                                <x-jet-input-error for="courses"/>
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
