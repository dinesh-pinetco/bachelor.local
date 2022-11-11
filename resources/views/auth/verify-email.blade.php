<x-guest-layout>
    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>
    <div class="h-full w-full absolute inset-0 z-0">
        <img src="images/register-bg.png" alt="verify email background image"
             class="h-full w-full object-cover object-center">
    </div>

    <div class="mb-4 text-sm text-gray">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif
    <div class="w-full max-w-md p-4 lg:p-10 xl:p-16 bg-white relative lg:ml-auto lg:mr-40 xl:mr-80 mt-10 md:mt-0">
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
