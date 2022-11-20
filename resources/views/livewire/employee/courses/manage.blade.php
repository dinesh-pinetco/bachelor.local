<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16 ">
                    <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __('Course') }}</h2>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="courseForm">
                        <div class="space-y-8">
                            <div>
                                <x-jet-label for="name" class="block required">{{ __('Name') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="name" :placeholder="__('Name')"
                                             wire:model.defer="course.name" id="name"></x-jet-input>
                                <x-jet-input-error for="course.name"/>
                            </div>

                            <div>
                                <x-jet-label for="sana_id" class="block required">{{ __('sANNA Id') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="sana_id" :placeholder="__('sANNA Id')"
                                             wire:model.defer="course.sana_id" id="sana_id"></x-jet-input>
                                <x-jet-input-error for="course.sana_id"/>
                            </div>

                            <div>
                                <x-jet-label for="form_of_study" class="block required">{{ __('Form of study') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="form_of_study" :placeholder="__('Form of study')"
                                             wire:model.defer="course.form_of_study" id="form_of_study"></x-jet-input>
                                <x-jet-input-error for="course.form_of_study"/>
                            </div>

                            <div>
                                <x-jet-label for="description" class="block required">{{ __('Description') }}
                                </x-jet-label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" wire:model.defer="course.description" placeholder="{{__('Description')}}"
                                              rows="3"
                                              class="w-full border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-primary placeholder-gray shadow-sm"></textarea>
                                    <x-jet-input-error for="course.description"/>
                                </div>
                            </div>

                            <div>
                                <x-jet-label for="name" class="block">{{ __('Assign Course') }}
                                </x-jet-label>
                                <x-multi-select name='selectedDesiredBeginnings' :options='$desiredBeginnings' :summeryText='$selectedDesiredBeginningsSummary' placeholder="{{ __('Select start (Summer/Winter)') }}" />
                                <x-jet-input-error for="selectedDesiredBeginnings" />
                            </div>

                            <div>
                                <x-jet-label for="name" class="block required">{{ __('First Start') }}
                                </x-jet-label>
                                <livewire:semester-date :value="$course->first_start" type="first_start" />
                                <x-jet-input-error for="course.first_start" />
                            </div>

                            <div>
                                <x-jet-label for="name" class="block">{{ __('Last Start') }}
                                </x-jet-label>
                                <livewire:semester-date :value="$course->last_start" type="last_start" />
                                <x-jet-input-error for="course.last_start" />
                            </div>

                            <div>
                                <x-jet-label for="lead_time" class="block required">{{ __('Lead Time') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="number" name="lead_time" :placeholder="__('Lead Time')"
                                             wire:model.defer="course.lead_time" id="lead_time"></x-jet-input>
                                <x-jet-input-error for="course.lead_time"/>
                            </div>

                            <div>
                                <x-jet-label for="dead_time" class="block required">{{ __('Dead Time') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="number" name="dead_time" :placeholder="__('Dead Time')"
                                             wire:model.defer="course.dead_time" id="dead_time"></x-jet-input>
                                <x-jet-input-error for="course.dead_time"/>
                            </div>

                            <div>
                                <x-jet-label for="is_active" class="block required">{{ __('Status') }}</x-jet-label>
                                <x-livewire-select id="is_active" name="is_active" model="course.is_active"
                                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">{{ __('Please select') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('InActive') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="course.is_active"/>
                            </div>

                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit" class="">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
