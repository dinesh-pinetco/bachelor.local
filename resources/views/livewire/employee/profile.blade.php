<div>
    <div class="max-w-screen-lg w-full mx-auto">
        <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Profile') }}
        </h2>
        <form wire:submit.prevent="submit" id="courseForm">
            <div class="-mx-4 flex flex-wrap justify-between items-start">
                <div class="px-4 w-full lg:w-1/2 xl:w-2/5 space-y-8">
                    <div>
                        <x-jet-label value="{{ __('First Name') }}"/>
                        <x-jet-input class="w-full" type="text" wire:model.defer="user.first_name"
                                     placeholder="{{ __('Enter First Name') }}"/>
                        <x-jet-input-error for="user.first_name" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Last Name') }}"/>
                        <x-jet-input class="w-full" type="text" wire:model.defer="user.last_name"
                                     placeholder="{{ __('Enter last name') }}"/>
                        <x-jet-input-error for="user.last_name" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Phone number') }}"/>
                        <x-jet-input class="w-full" type="tel" wire:model.defer="user.phone"
                                     placeholder="{{ __('Enter phone number') }}"/>
                        <x-jet-input-error for="user.phone" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Language') }}"/>
                        <x-livewire-select id="locale"
                                           name="locale"
                                           model="user.locale"
                                           :value="$user->locale"
                                           class="w-full">
                            <option value="">{{ __('Please select') }}</option>
                            <option value="en">{{ __('English') }}</option>
                            <option value="de">{{ __('German') }}</option>
                        </x-livewire-select>
                        <x-jet-input-error for="user.locale" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Current Password') }}"/>
                        <x-jet-input class="w-full" type="password" wire:model.defer="user.old_password"
                                     placeholder="{{ __('Enter Current Password') }}"/>
                        <x-jet-input-error for="user.old_password" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('New Password') }}"/>
                        <x-jet-input class="w-full" type="password" wire:model.defer="user.new_password"
                                     placeholder="{{ __('Enter New Password') }}"/>
                        <x-jet-input-error for="user.new_password" class="mt-2"/>
                    </div>

                    <div>
                        <x-jet-label value="{{ __('Confirm Password') }}"/>
                        <x-jet-input class="w-full" type="password" wire:model.defer="user.confirm_password"
                                     placeholder="{{ __('Enter Confirm Password') }}"/>
                        <x-jet-input-error for="user.confirm_password" class="mt-2"/>
                    </div>
                    <div class="text-right">
                        <button type="submit" wire:loading.attr="disabled" wire:loading.class="cursor-wait"
                                class="inline-block px-4 py-2 -mt-0 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out">
                            {{__('Save')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

