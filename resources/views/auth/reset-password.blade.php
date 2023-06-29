<x-guest-layout>
    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>
    <div class="h-full w-full absolute inset-0 z-0">
        <img src="/images/register-bg.webp" alt="reset password background image"
             class="h-full w-full object-cover object-top">
    </div>
    <div
        class="flex flex-col justify-start items-center mb-6 mt-6 md:mt-44 w-full overflow-y-auto">
        <div class="flex flex-col flex-grow justify-start w-full max-w-screen-lg">
            <div
                class="mt-10 md:mt-0 mx-auto md:ml-auto md:mr-20 xl:mr-0 w-full md:max-w-md p-4 lg:p-10 xl:p-20 bg-white relative shadow-xl">
                <x-jet-validation-errors class="mb-4"/>
                <h2 class="text-2xl text-primary font-bold mb-8">{{__('Reset Password')}}</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="block">
                        <x-jet-label class="text-sm text-black font-light required" for="email"
                                     value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="block w-full" type="email" name="email"
                                     placeholder="{{ __('Email') }}"
                                     :value="old('email', $request->email)" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label class="text-sm text-black font-light required" for="password"
                                     value="{{ __('New Password') }}"/>
                        <x-jet-input id="password" class="block w-full" type="password" name="password"
                                     placeholder="{{ __('New Password') }}"
                                     required
                                     autocomplete="new-password"/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label class="text-sm text-black font-light required" for="email"
                                     for="password_confirmation"
                                     value="{{ __('Confirm Password') }}"/>
                        <x-jet-input id="password_confirmation" class="block w-full" type="password"
                                     name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                                     autocomplete="new-password"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="text-xs font-medium w-full">
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
