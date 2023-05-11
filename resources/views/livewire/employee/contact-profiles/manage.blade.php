<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h3 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __('Contact Profile') }}</h3>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="contactProfileForm">
                        <div class="space-y-7 overflow-y-auto px-4 -mx-4">
                            <div>
                                <div x-data="{photoName: null, photoPreview: null}">
                                    <div class="flex flex-col items-start">
                                        {{--current photo--}}
                                        <div
                                            class="mb-4 overflow-hidden rounded-full shadow w-28 h-28 xl:w-36 xl:h-36">
                                            <img x-show="! photoPreview"
                                                 class="object-cover object-center w-full h-full"
                                                 src="{{ $this->contactProfile->profile_photo_url }}"
                                                 alt="{{ $contactProfile->name }}">
                                            <span class="block rounded-full w-28 h-28 xl:w-36 xl:h-36 mb-4 shadow"
                                                  x-cloak x-show="photoPreview"
                                                  x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                            </span>
                                        </div>
                                        {{--new photo--}}
                                        <label
                                            class="inline-block px-4 py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out">
                                            <span class="xl:text-lg"><i class="fal fa-edit"></i></span>
                                            <span class="ml-1">{{ __('Choose Photo') }}</span>
                                            <input type="file" class="hidden" wire:model="photo" name="photo"
                                                   x-ref="photo"
                                                   x-on:change="
                                                            photoName = $refs.photo.files[0].name;
                                                            const reader = new FileReader();
                                                            reader.onload = (e) => {
                                                                photoPreview = e.target.result;
                                                            };
                                                            reader.readAsDataURL($refs.photo.files[0]);
                                                       ">
                                        </label>
                                        @if ($contactProfile->profile_photo_path)
                                            <a href="javascript:void(0);" wire:click="deletePhoto"
                                               class="inline-block px-4 py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out">
                                                <span class="xl:text-lg"><i class="fal fa-trash-alt"></i></span>
                                                <span class="ml-1">{{ __('Remove Photo') }}</span>
                                            </a>
                                    @endif
                                    <!-- Remove Button End -->
                                    </div>
                                </div>
                                <x-jet-input-error for="photo" class="mt-2 text-red"/>
                            </div>

                            <div>
                                <x-jet-label for="name"
                                             class="block required">{{ __('Name') }}</x-jet-label>
                                <x-jet-input type="text" name="name" wire:model.defer="contactProfile.name" id="name" :placeholder="__('Name')"
                                             class="w-full"></x-jet-input>
                                <x-jet-input-error for="contactProfile.name"/>
                            </div>

                            <div>
                                <x-jet-label for="email"
                                             class="block required">{{ __('Email') }}</x-jet-label>
                                <x-jet-input type="email" name="email" wire:model.defer="contactProfile.email" :placeholder="__('Email')"
                                             id="email"
                                             class="w-full"></x-jet-input>
                                <x-jet-input-error for="contactProfile.email"/>
                            </div>

                            <div>
                                <x-jet-label for="phone"
                                             class="block required">{{ __('Phone') }}</x-jet-label>
                                    <div>
                                    <x-tel-input-phone setValue="{{$contactProfile->phone}}" setKey="contactProfile.phone" />
                                    </div>
                                <x-jet-input-error for="contactProfile.phone"/>
                            </div>

                            <div>
                                <x-jet-label for="name" class="block">{{ __('Assign Course') }}</x-jet-label>
                                <x-multi-select
                                    wire:model="selectedCourses"
                                    :placeholder="__('Select course')"
                                    :options='$courses'
                                    :value="$selectedCourses"
                                    key-by="id"
                                    label-by="name"
                                />
                                <x-jet-input-error for="selectedCourses"/>
                            </div>
                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit"
                                              class="inline-flex">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
