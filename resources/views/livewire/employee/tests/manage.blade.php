<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h3 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">Test</h3>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="testForm">
                        <div class="space-y-7">

                            <div>
                                <x-jet-label for="name" class="block required">{{ __('Name') }}</x-jet-label>
                                <x-jet-input type="text" name="name" wire:model.defer="test.name" id="name" :placeholder="__('Name')"
                                    class="w-full"></x-jet-input>
                                <x-jet-input-error for="test.name" />
                            </div>

                            <div>
                                <x-jet-label for="description" class="block required">{{ __('Description') }}
                                </x-jet-label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" wire:model.defer="test.description" placeholder="Description"
                                        rows="3"
                                        class="w-full border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-primary placeholder-gray resize-none shadow-sm"></textarea>
                                    <x-jet-input-error for="test.description" />
                                </div>
                            </div>

                            <div>
                                <x-jet-label for="type" class="block required">{{ __('Type') }}</x-jet-label>
                                <select
                                    class="w-full py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                    id="type" name="type" wire:model="test.type">
                                    <option value=""> {{ __('Select Type') }}</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="test.type" />
                            </div>

                            <div>
                                <x-jet-label for="duration" class="block required">{{ __('Duration') }}
                                    ({{ __('Min') }})</x-jet-label>
                                <x-livewire-select id="duration" name="duration" model="test.duration"
                                    class="w-full">
                                    <option value="">{{ __('Select Duration') }}</option>
                                    @for ($i = 10; $i <= 60; $i++)
                                        <option value="{{ number_format($i, 2) }}">{{ $i . ' ' . __('Minute') }}
                                        </option>
                                    @endfor
                                </x-livewire-select>
                                <x-jet-input-error for="test.duration" />
                            </div>

                            <div>
                                <x-jet-label for="name" class="block">{{ __('Assign Course') }}</x-jet-label>
                                <x-multi-select name='selectedCourses' :placeholder="__('Select course')" :options='$courses' :summeryText='$selectedCoursesSummery' />
                                <x-jet-input-error for="courses" />
                            </div>

                            <div>
                                <x-jet-label for="is_active" class="block required">{{ __('Status') }}</x-jet-label>
                                <x-livewire-select id="is_active" name="is_active" model="test.is_active"
                                    class="w-full">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('InActive') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="test.is_active" />
                            </div>

                            <div>
                                <x-jet-label for="is_required" class="block required">{{ __('Required') }}
                                </x-jet-label>
                                <x-livewire-select id="is_required" name="is_required" model="test.is_required"
                                    class="w-full">
                                    <option value="">{{ __('Select required') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </x-livewire-select>
                                <x-jet-input-error for="test.is_required" />
                            </div>

                            <div>
                                <x-jet-label for="link" class="block required">{{ __('Link') }}</x-jet-label>
                                <x-jet-input type="url" name="link" wire:model.defer="test.link" autocomplete="url" :placeholder="__('Link')"
                                    id="link" class="w-full"></x-jet-input>
                                <x-jet-input-error for="test.link" />
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
