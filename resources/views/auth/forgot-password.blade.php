<x-guest-layout>
    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>
    <div class="h-full w-full absolute inset-0 z-0">
        <img src="/images/register-bg.webp" alt="register background image"
             class="h-full w-full object-cover object-top">
             <div class="register-grediant absolute inset-0 mt-auto z-0"></div>
    </div>
    <div class="mb-4 text-sm text-gray">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <div
        class="flex flex-col justify-start items-center mb-6 mt-6 md:mt-44 w-full overflow-y-auto">
        <div class="flex flex-col flex-grow justify-start w-full max-w-screen-lg">
            <div
                class="mx-auto md:ml-auto md:mr-20 xl:mr-0 w-full md:max-w-md p-4 lg:p-10 xl:p-20 bg-white relative shadow-xl">
                @if(session()->get('message'))
                    <p class="text-primary mb-4">{{session()->get('message')}}</p>
                @endif
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-primary">
                        {{ session('status') }}
                    </div>
                @endif
                <x-jet-validation-errors class="mb-4"/>
                <h2 class="text-2xl text-primary font-bold mb-8">{{__('Password forgotten')}}</h2>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="block">
                        <x-jet-label class="text-sm text-black font-light required" for="email"
                                     value="{{ __('E-mail address') }}"/>
                        <x-jet-input class="block w-full" id="email" type="email" name="email"
                                     placeholder="{{ __('Enter e-mail address') }}" :value="old('email')"
                                     required
                                     autofocus/>
                    </div>
                    <div class="flex items-center justify-end my-4 md:my-8">
                        <x-primary-button class="text-xs font-medium w-full -mt-0">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                    <div>
                        <p class="text-primary text-xs font-bold">{{ __('Back To') }}?
                            <a href="{{ route('login') }}" class="inline-block underline">{{ __('Log in') }}</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
