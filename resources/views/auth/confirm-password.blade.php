<x-guest-layout>
    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>
    <div class="h-full w-full absolute inset-0 z-0">
        <img src="images/register-bg.webp" alt="confirm password background image"
             class="h-full w-full object-cover object-top">
             <div class="register-grediant absolute inset-0 mt-auto z-0"></div>
    </div>

    <div class="mb-4 text-sm text-gray">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>
    <div
        class="flex flex-col justify-start items-center mb-6 mt-6 md:mt-44 w-full overflow-y-auto">
        <div class="flex flex-col flex-grow justify-start w-full max-w-screen-lg">
            <div
                class="mx-auto md:ml-auto md:mr-20 xl:mr-0 w-full md:max-w-md p-4 lg:p-10 xl:p-20 bg-white relative shadow-xl">
                <x-jet-validation-errors class="mb-4"/>
                <h2 class="text-2xl text-primary font-bold mb-8">{{__('Confirm Password')}}</h2>
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div>
                        <x-jet-label class="text-sm text-black font-light required" for="password"
                                     value="{{ __('Password') }}"/>
                        <x-jet-input id="password" class="block w-full" type="password" name="password"
                                     placeholder="{{ __('Password') }}"
                                     required
                                     autocomplete="current-password" autofocus/>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button class="text-xs font-medium w-full">
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
