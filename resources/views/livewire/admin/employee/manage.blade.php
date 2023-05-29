<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16 ">
                    <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __('Employee') }}</h2>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="courseForm">
                        <div class="space-y-8">
                            <div>
                                <x-jet-label for="first_name" class="block required">{{ __('First name') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="first_name" :placeholder="__('First name')"
                                             wire:model.defer="user.first_name" id="first_name"></x-jet-input>
                                <x-jet-input-error for="user.first_name"/>
                            </div>
                            <div>
                                <x-jet-label for="last_name" class="block required">{{ __('Last name') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="last_name" :placeholder="__('Last name')"
                                             wire:model.defer="user.last_name" id="last_name"></x-jet-input>
                                <x-jet-input-error for="user.last_name"/>
                            </div>
                            <div>
                                <x-jet-label for="email" class="block required">{{ __('Email Address') }}</x-jet-label>
                                <x-jet-input class="w-full" type="text" name="email" :placeholder="__('Enter Email Address')"
                                             wire:model.defer="user.email" id="email"></x-jet-input>
                                <x-jet-input-error for="user.email"/>
                            </div>
                            <div>
                                <x-jet-label for="phone" class="block">{{ __('Phone') }}</x-jet-label>
                                <div wire:ignore>
                                    <x-tel-input
                                        id="phone"
                                        value="{{ $user->phone }}"
                                        placeholder="{{ __('Enter phone number') }}"
                                        class="w-full h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray"
                                    />
                                </div>
                                <x-jet-input-error for="user.phone"/>
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
    <script>
        const input = document.querySelector("#phone");
        input.addEventListener('telchange', function(e) {
            if(e.detail.valid)
            {
                @this.set('user.phone', e.detail.number);
            } else {
                if(e.detail.number.includes(e.detail.dialCode)){
                    @this.set('user.phone', e.detail.number);
                } else {
                    const combineString = "+" + e.detail.dialCode + "" + e.detail.number;
                    @this.set('user.phone', combineString);
                }
            }
        });
    </script>
</div>
