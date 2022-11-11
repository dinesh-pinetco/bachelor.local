<x-guest-layout>

    <div class="md:absolute top-0 left-20 z-50 bg-white w-full max-w-sm p-4 md:p-8 shadow-xl">
        <x-jet-authentication-card-logo/>
    </div>

    <div class="h-full w-full absolute inset-0 z-0">
        <img src="images/register-bg.png" alt="register background image"
             class="h-full w-full object-cover object-top">
        <div class="register-grediant absolute inset-0 mt-auto z-0"></div>
    </div>
    <div
        class="px-1 md:px-4 flex flex-col justify-start items-center mb-6 mt-6 md:mt-44 relative w-full overflow-y-auto">
        <div class="flex flex-col flex-grow justify-start w-full h-full max-w-screen-lg">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-semibold mb-4">{{ __('Your application starts here') }}</h1>
                <div
                    class="flex items-start bg-primary text-white p-4 md:pl-6 md:pr-12 py-4 text-sm max-w-screen-md space-x-3 my-4 lg:my-7">
                    <div class="flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23984 18.6518 7.55544C19.5308 8.87103 20 10.4177 20 12C20 14.1217 19.1572 16.1566 17.6569 17.6569C16.1566 19.1571 14.1217 20 12 20Z"
                                fill="white"/>
                            <path
                                d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                                fill="white"/>
                            <path
                                d="M12 7C11.7348 7 11.4804 7.10536 11.2929 7.29289C11.1054 7.48043 11 7.73478 11 8V13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14C12.2652 14 12.5196 13.8946 12.7071 13.7071C12.8946 13.5196 13 13.2652 13 13V8C13 7.73478 12.8946 7.48043 12.7071 7.29289C12.5196 7.10536 12.2652 7 12 7Z"
                                fill="white"/>
                        </svg>
                    </div>
                    <p class="text-xs">
                        {{ __('register page title') }} <a href="mailto:{{ config('mail.supporter.address') }}"
                                                           class="inline-block underline"> {{ __('register page office') }}</a>
                    </p>
                </div>
            </div>

            <x-jet-validation-errors class="mb-4 bg-white p-4 rounded"></x-jet-validation-errors>

            <livewire:register />
        </div>
    </div>

</x-guest-layout>
