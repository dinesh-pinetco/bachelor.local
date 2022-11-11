<x-guest-layout>

    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>
    <div class="h-full w-full absolute inset-0 z-0">
        <img src="images/login.png" alt="login background image"
             class="h-full w-full object-cover object-top">
    </div>


    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <div
        class="flex flex-col justify-start items-center mb-6 mt-6 md:mt-44 w-full overflow-y-auto">
        <div class="flex flex-col flex-grow justify-start w-full max-w-screen-lg">
            <div
                class="mx-auto md:ml-auto md:mr-20 xl:mr-0 w-full md:max-w-md p-4 lg:p-10 xl:p-20 bg-white relative shadow-xl">
                @if(session()->get('message'))
                    <div class="flex space-x-2 p-4 bg-primary-light bg-opacity-25 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary flex-shrink-0" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-primary">{{session()->get('message')}}</p>
                    </div>
                @endif
                <x-jet-validation-errors class="mb-4"/>
                <h2 class="text-2xl text-primary font-bold mb-8">{{__('Applicant portal')}}</h2>
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div>
                        <x-jet-label class="text-sm text-black font-light required" for="email"
                                     value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="block mt-2.5 w-full" type="email" name="email"
                                     placeholder="{{ __('Enter email address') }}"
                                     :value="old('email') ?? request()->get('email')"
                                     required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label class="text-sm text-black font-light required" for="password"
                                     value="{{ __('Password') }}"/>
                        <x-jet-input id="password" class="block mt-2.5 w-full" type="password"
                                     placeholder="{{ __('Password') }}"
                                     name="password" required
                                     autocomplete="current-password"/>
                    </div>
                    <div class="flex my-4 md:my-8">
                        <x-primary-button class="flex items-center text-xs font-medium -mt-0">
                            {{ __('Log in') }}
                            <svg class="stroke-current ml-4" width="25" height="24" viewBox="0 0 25 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.5 8L17.5 12M17.5 12L13.5 16M17.5 12L3.5 12M8.5 8V7C8.5 6.20435 8.81607 5.44129 9.37868 4.87868C9.94129 4.31607 10.7044 4 11.5 4H18.5C19.2956 4 20.0587 4.31607 20.6213 4.87868C21.1839 5.44129 21.5 6.20435 21.5 7V17C21.5 17.7956 21.1839 18.5587 20.6213 19.1213C20.0587 19.6839 19.2956 20 18.5 20H11.5C10.7044 20 9.94129 19.6839 9.37868 19.1213C8.81607 18.5587 8.5 17.7956 8.5 17V16"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </x-primary-button>
                    </div>

                    <div
                        class="mt-4 text-xs text-primary font-bold hover:text-light-primary">{{ __("Don't have an account") }}
                        ?
                        <a href="/" class="inline-block underline ">{{ __('Register') }}</a>
                    </div>
                    <div class="mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-xs text-primary font-bold hover:text-light-primary underline"
                               href="{{ route('password.request') }}">
                                {{ __('Password forgotten') }}
                            </a>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
