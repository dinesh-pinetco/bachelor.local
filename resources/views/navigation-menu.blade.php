@impersonating
    @include('partials._impersonating_headline')
@endImpersonating
<nav x-data="{ open: false }" class="h-screen shadow-xl relative z-50 bg-white overflow-y-auto">

    <!-- Primary Navigation Menu -->
    <div class="py-4 md:py-6 h-full">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center mb-5 px-4">
                    <a href="{{ auth()->user()->hasRole(ROLE_APPLICANT)?route('dashboard'):route('employee.dashboard') }}"
                       class="inline-block w-full">
                        <x-jet-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>
                <!-- Navigation Links for Applicant -->
                @unlessrole(ROLE_APPLICANT)
                <ul class="flex flex-col space-y-2 sidebar-menu flex-grow">
                    <li>
                        <x-jet-nav-link href="{{ route('employee.dashboard') }}"
                                        :active="request()->routeIs('employee.dashboard')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                    <path
                                        d="M2 8L3.33333 6.66667M3.33333 6.66667L8 2L12.6667 6.66667M3.33333 6.66667V13.3333C3.33333 13.5101 3.40357 13.6797 3.5286 13.8047C3.65362 13.9298 3.82319 14 4 14H6M12.6667 6.66667L14 8M12.6667 6.66667V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H10M6 14C6.17681 14 6.34638 13.9298 6.4714 13.8047C6.59643 13.6797 6.66667 13.5101 6.66667 13.3333V10.6667C6.66667 10.4899 6.7369 10.3203 6.86193 10.1953C6.98695 10.0702 7.15652 10 7.33333 10H8.66667C8.84348 10 9.01305 10.0702 9.13807 10.1953C9.2631 10.3203 9.33333 10.4899 9.33333 10.6667V13.3333C9.33333 13.5101 9.40357 13.6797 9.5286 13.8047C9.65362 13.9298 9.82319 14 10 14M6 14H10"
                                        stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span>{{ __('Dashboard') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.profile') }}"
                                        :active="request()->routeIs('employee.profile')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                    <path
                                        d="M9.88554 6.55229C10.3856 6.05219 10.6666 5.37391 10.6666 4.66667C10.6666 3.95942 10.3856 3.28115 9.88554 2.78105C9.38544 2.28095 8.70716 2 7.99992 2C7.29267 2 6.6144 2.28095 6.1143 2.78105C5.6142 3.28115 5.33325 3.95942 5.33325 4.66667C5.33325 5.37391 5.6142 6.05219 6.1143 6.55229C6.6144 7.05238 7.29267 7.33333 7.99992 7.33333C8.70716 7.33333 9.38544 7.05238 9.88554 6.55229Z"
                                        stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path
                                        d="M4.70009 10.7002C5.57526 9.825 6.76224 9.33333 7.99992 9.33333C9.2376 9.33333 10.4246 9.825 11.2998 10.7002C12.1749 11.5753 12.6666 12.7623 12.6666 14H3.33325C3.33325 12.7623 3.82492 11.5753 4.70009 10.7002Z"
                                        stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span>{{ __('Profile') }}</span>
                        </x-jet-nav-link>
                    </li>
                    @if(auth()->user()->hasAnyRole([ROLE_ADMIN,ROLE_SUPER_ADMIN]))
                        <li>
                            <x-jet-nav-link href="{{ route('admin.employees.index') }}"
                                            :active="request()->routeIs('admin.employees.index')"
                                            class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                <div
                                    class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 640 512">
                                        <path
                                            d="M160 320c53.02 0 96-42.98 96-96c0-53.02-42.98-96-96-96C106.1 128 64 170.1 64 224C64 277 106.1 320 160 320zM160 160c35.29 0 64 28.71 64 64S195.3 288 160 288S96 259.3 96 224S124.7 160 160 160zM192 352H128c-70.69 0-128 57.31-128 128c0 17.67 14.33 32 32 32h256c17.67 0 32-14.33 32-32C320 409.3 262.7 352 192 352zM32 480c0-52.94 43.07-96 96-96h64c52.94 0 96 43.06 96 96H32zM592 0h-384C181.5 0 160 21.53 160 48v32C160 88.84 167.2 96 176 96S192 88.84 192 80v-32C192 39.19 199.2 32 208 32h384C600.8 32 608 39.19 608 48v320c0 8.812-7.172 16-16 16H576v-48C576 309.5 554.5 288 528 288h-96C405.5 288 384 309.5 384 336V384h-32c-8.844 0-16 7.156-16 16S343.2 416 352 416h240C618.5 416 640 394.5 640 368v-320C640 21.53 618.5 0 592 0zM544 384h-128v-48c0-8.812 7.172-16 16-16h96c8.828 0 16 7.188 16 16V384z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Employee') }}</span>
                            </x-jet-nav-link>
                        </li>
                    @endif
                    <li>
                        <x-jet-nav-link href="{{ route('employee.applicants.index') }}"
                                        :active="request()->routeIs('employee.applicants.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5 fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4599 14.48C9.4999 14.48 7.8999 12.88 7.8999 10.92C7.8999 8.95998 9.4999 7.35999 11.4599 7.35999C13.4199 7.35999 15.0199 8.95998 15.0199 10.92C15.0199 12.88 13.4199 14.48 11.4599 14.48ZM11.4599 8.87C10.3299 8.87 9.3999 9.78999 9.3999 10.93C9.3999 12.07 10.3199 12.99 11.4599 12.99C12.5999 12.99 13.5199 12.07 13.5199 10.93C13.5199 9.78999 12.5999 8.87 11.4599 8.87Z" fill="currentColor"/>
                                    <path d="M16.65 20.95C16.24 20.95 15.9 20.61 15.9 20.2C15.9 18.28 13.91 16.72 11.46 16.72C9.01002 16.72 7.02002 18.28 7.02002 20.2C7.02002 20.61 6.68002 20.95 6.27002 20.95C5.86002 20.95 5.52002 20.61 5.52002 20.2C5.52002 17.46 8.18002 15.22 11.46 15.22C14.74 15.22 17.4 17.45 17.4 20.2C17.4 20.61 17.06 20.95 16.65 20.95Z" fill="currentColor"/>
                                    <path d="M11.5 22.75C5.85 22.75 1.25 18.15 1.25 12.5C1.25 6.85 5.85 2.25 11.5 2.25C12.89 2.25 14.23 2.51999 15.49 3.04999C15.85 3.19999 16.03 3.59997 15.91 3.96997C15.8 4.29997 15.75 4.65 15.75 5C15.75 5.59 15.91 6.16998 16.22 6.66998C16.38 6.94998 16.59 7.19997 16.83 7.40997C17.7 8.19997 18.99 8.45003 20 8.09003C20.37 7.95003 20.79 8.14001 20.94 8.51001C21.48 9.78001 21.75 11.13 21.75 12.51C21.75 18.15 17.15 22.75 11.5 22.75ZM11.5 3.75C6.68 3.75 2.75 7.67 2.75 12.5C2.75 17.33 6.68 21.25 11.5 21.25C16.32 21.25 20.25 17.33 20.25 12.5C20.25 11.54 20.09 10.59 19.79 9.67999C18.41 9.91999 16.9 9.49002 15.84 8.52002C15.49 8.22002 15.18 7.85 14.94 7.44C14.5 6.72 14.26 5.87 14.26 5C14.26 4.73 14.28 4.47002 14.33 4.21002C13.42 3.90002 12.47 3.75 11.5 3.75Z" fill="currentColor"/>
                                    <path d="M19 9.75C17.82 9.75 16.7 9.31002 15.83 8.52002C15.48 8.22002 15.17 7.85 14.93 7.44C14.49 6.72 14.25 5.87 14.25 5C14.25 4.49 14.33 3.99001 14.49 3.51001C14.71 2.83001 15.09 2.2 15.6 1.69C16.5 0.770002 17.71 0.25 19.01 0.25C20.37 0.25 21.66 0.830017 22.54 1.83002C23.32 2.70002 23.76 3.82 23.76 5C23.76 5.38 23.71 5.75999 23.61 6.12C23.51 6.56999 23.32 7.04001 23.06 7.45001C22.48 8.43001 21.56 9.16 20.48 9.5C20.03 9.67 19.53 9.75 19 9.75ZM19 1.75C18.11 1.75 17.28 2.09998 16.67 2.72998C16.32 3.08998 16.07 3.49997 15.92 3.96997C15.81 4.29997 15.76 4.65 15.76 5C15.76 5.59 15.92 6.16998 16.23 6.66998C16.39 6.94998 16.6 7.19997 16.84 7.40997C17.71 8.19997 19 8.45003 20.01 8.09003C20.77 7.85003 21.39 7.34999 21.79 6.67999C21.97 6.38999 22.09 6.08002 22.16 5.77002C22.23 5.51002 22.26 5.26 22.26 5C22.26 4.2 21.96 3.43002 21.42 2.83002C20.81 2.14002 19.93 1.75 19 1.75Z" fill="currentColor"/>
                                    <path d="M20.49 5.72998H17.5C17.09 5.72998 16.75 5.38998 16.75 4.97998C16.75 4.56998 17.09 4.22998 17.5 4.22998H20.49C20.9 4.22998 21.24 4.56998 21.24 4.97998C21.24 5.38998 20.91 5.72998 20.49 5.72998Z" fill="currentColor"/>
                                    <path d="M19 7.26001C18.59 7.26001 18.25 6.92001 18.25 6.51001V3.52002C18.25 3.11002 18.59 2.77002 19 2.77002C19.41 2.77002 19.75 3.11002 19.75 3.52002V6.51001C19.75 6.93001 19.41 7.26001 19 7.26001Z" fill="currentColor"/>
                                </svg>

                            </div>
                            <span>{{ __('Applicants') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.desired-beginning.index') }}"
                                        :active="request()->routeIs('employee.desired-beginning.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                </svg>
                            </div>
                            <span>{{ __('Desire Beginning') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.courses.index') }}"
                                        :active="request()->routeIs('employee.courses.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                </svg>
                            </div>
                            <span>{{ __('Courses') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.documents.index') }}"
                                        :active="request()->routeIs('employee.documents.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 384 512">
                                    <path
                                        d="M365.3 125.3l-106.5-106.5C246.7 6.742 230.5 0 213.5 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.35 28.65 64 64 64H320c35.35 0 64-28.65 64-64v-277.5C384 153.5 377.3 137.3 365.3 125.3zM342.6 147.9C346.1 151.3 348.4 155.5 349.9 160H240C231.2 160 224 152.8 224 144V34.08c4.477 1.566 8.666 3.846 12.12 7.299L342.6 147.9zM352 448c0 17.64-14.36 32-32 32H64c-17.64 0-32-14.36-32-32V64c0-17.64 14.36-32 32-32h128v112C192 170.5 213.5 192 240 192H352V448z"/>
                                </svg>
                            </div>
                            <span>{{ __('Documents') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.tests.index') }}"
                                        :active="request()->routeIs('employee.tests.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M176 96C167.2 96 160 103.2 160 112V256H64V112C64 103.2 56.84 96 48 96S32 103.2 32 112v288C32 444.1 67.88 480 112 480S192 444.1 192 400v-288C192 103.2 184.8 96 176 96zM160 400C160 426.5 138.5 448 112 448S64 426.5 64 400V288h96V400zM464 96C455.2 96 448 103.2 448 112V256h-96V112C352 103.2 344.8 96 336 96S320 103.2 320 112v288c0 44.13 35.88 80 80 80s80-35.88 80-80v-288C480 103.2 472.8 96 464 96zM448 400c0 26.47-21.53 48-48 48S352 426.5 352 400V288h96V400zM208 32h-192C7.156 32 0 39.16 0 48S7.156 64 16 64h192C216.8 64 224 56.84 224 48S216.8 32 208 32zM496 32h-192C295.2 32 288 39.16 288 48S295.2 64 304 64h192C504.8 64 512 56.84 512 48S504.8 32 496 32z"/>
                                </svg>
                            </div>
                            <span>{{ __('Tests') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.settings.groups.index',['tab' => 'profile']) }}"
                                        :active="request()->routeIs('employee.settings.groups.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span>{{ __('Groups') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.settings.fields.index',['tab' => 'profile']) }}"
                                        :active="request()->routeIs('employee.settings.fields.*') || request()->routeIs('employee.options.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M168 255.1C168 207.4 207.4 167.1 256 167.1C304.6 167.1 344 207.4 344 255.1C344 304.6 304.6 344 256 344C207.4 344 168 304.6 168 255.1zM256 199.1C225.1 199.1 200 225.1 200 255.1C200 286.9 225.1 311.1 256 311.1C286.9 311.1 312 286.9 312 255.1C312 225.1 286.9 199.1 256 199.1zM65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6V230.6zM158.4 129.2L145.1 139.5L77.13 117.8L46.89 170.2L99.58 218.2L97.39 234.8C96.47 241.7 96 248.8 96 255.1C96 263.2 96.47 270.3 97.39 277.2L99.58 293.8L46.89 341.8L77.13 394.2L145.1 372.5L158.4 382.8C169.5 391.4 181.9 398.6 195 403.1L210.5 410.4L225.8 480H286.2L301.5 410.4L316.1 403.1C330.1 398.6 342.5 391.4 353.6 382.8L366.9 372.5L434.9 394.2L465.1 341.8L412.4 293.8L414.6 277.2C415.5 270.3 416 263.2 416 256C416 248.8 415.5 241.7 414.6 234.8L412.4 218.2L465.1 170.2L434.9 117.8L366.9 139.5L353.6 129.2C342.5 120.6 330.1 113.4 316.1 108L301.5 101.6L286.2 32H225.8L210.5 101.6L195 108C181.9 113.4 169.5 120.6 158.4 129.2H158.4z"/>
                                </svg>
                            </div>
                            <span>{{ __('Settings') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.contact-profiles.index') }}"
                                        :active="request()->routeIs('employee.contact-profiles.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M484.6 330.6C484.6 330.6 484.6 330.6 484.6 330.6l-101.8-43.66c-18.5-7.688-40.2-2.375-52.75 13.08l-33.14 40.47C244.2 311.8 200.3 267.9 171.6 215.2l40.52-33.19c15.67-12.92 20.83-34.16 12.84-52.84L181.4 27.37C172.7 7.279 150.8-3.737 129.6 1.154L35.17 23.06C14.47 27.78 0 45.9 0 67.12C0 312.4 199.6 512 444.9 512c21.23 0 39.41-14.44 44.17-35.13l21.8-94.47C515.7 361.1 504.7 339.3 484.6 330.6zM457.9 469.7c-1.375 5.969-6.844 10.31-12.98 10.31c-227.7 0-412.9-185.2-412.9-412.9c0-6.188 4.234-11.48 10.34-12.88l94.41-21.91c1-.2344 2-.3438 2.984-.3438c5.234 0 10.11 3.094 12.25 8.031l43.58 101.7C197.9 147.2 196.4 153.5 191.8 157.3L141.3 198.7C135.6 203.4 133.8 211.4 137.1 218.1c33.38 67.81 89.11 123.5 156.9 156.9c6.641 3.313 14.73 1.531 19.44-4.219l41.39-50.5c3.703-4.563 10.16-6.063 15.5-3.844l101.6 43.56c5.906 2.563 9.156 8.969 7.719 15.22L457.9 469.7z"/>
                                </svg>
                            </div>
                            <span>{{ __('Contact profiles') }}</span>
                        </x-jet-nav-link>
                    </li>
                    <li>
                        <x-jet-nav-link href="{{ route('employee.faq.index') }}"
                                        :active="request()->routeIs('employee.faq.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span>{{ __('Faq') }}</span>
                        </x-jet-nav-link>
                    </li>
                    @hasrole(ROLE_ADMIN)
                    <li>
                        <x-jet-nav-link href="{{ route('employee.logs.applicants') }}"
                                        :active="request()->routeIs('employee.logs.*')"
                                        class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                            <div
                                class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                <svg class="h-5 w-5 fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.3799 22.75H3.23993C2.28993 22.75 1.40993 22.31 0.839932 21.54C0.259932 20.76 0.0899403 19.78 0.37994 18.85L4.58993 5.31995C4.96993 4.05995 6.12995 3.19995 7.44995 3.19995H19.7499C20.9599 3.19995 22.0499 3.92004 22.5099 5.04004C22.7599 5.62004 22.8099 6.28005 22.6599 6.93005L19.2899 20.46C18.9699 21.81 17.7699 22.75 16.3799 22.75ZM7.45993 4.70996C6.80993 4.70996 6.21993 5.14002 6.02993 5.77002L1.81994 19.3C1.67994 19.77 1.75993 20.26 2.05993 20.66C2.33993 21.04 2.77994 21.26 3.24994 21.26H16.3899C17.08 21.26 17.6799 20.79 17.8399 20.12L21.2099 6.57996C21.2899 6.24996 21.2699 5.92 21.1399 5.63C20.9 5.06 20.3699 4.69995 19.7599 4.69995H7.45993V4.70996Z" fill="currentColor"/>
                                    <path d="M20.78 22.75H16C15.59 22.75 15.25 22.41 15.25 22C15.25 21.59 15.59 21.25 16 21.25H20.78C21.19 21.25 21.57 21.08 21.85 20.78C22.13 20.48 22.27 20.08 22.24 19.67L21.25 6.05002C21.22 5.64002 21.53 5.27997 21.94 5.24997C22.35 5.22997 22.71 5.52991 22.74 5.93991L23.73 19.56C23.79 20.38 23.5 21.2 22.94 21.8C22.39 22.41 21.6 22.75 20.78 22.75Z" fill="currentColor"/>
                                    <path d="M9.67977 7.12996C9.61977 7.12996 9.55977 7.11994 9.49977 7.10994C9.09977 7.00994 8.84979 6.6099 8.94979 6.1999L9.98976 1.87996C10.0898 1.47996 10.4898 1.22991 10.8998 1.32991C11.2998 1.42991 11.5498 1.82994 11.4498 2.23994L10.4098 6.56001C10.3298 6.90001 10.0198 7.12996 9.67977 7.12996Z" fill="currentColor"/>
                                    <path d="M16.3799 7.13999C16.3299 7.13999 16.2699 7.13997 16.2199 7.11997C15.8199 7.02997 15.56 6.62995 15.64 6.22995L16.5799 1.88999C16.6699 1.47999 17.0699 1.23003 17.4699 1.31003C17.8699 1.39003 18.1299 1.79992 18.0499 2.19992L17.1099 6.54001C17.0399 6.90001 16.7299 7.13999 16.3799 7.13999Z" fill="currentColor"/>
                                    <path d="M15.7002 12.75H7.7002C7.2902 12.75 6.9502 12.41 6.9502 12C6.9502 11.59 7.2902 11.25 7.7002 11.25H15.7002C16.1102 11.25 16.4502 11.59 16.4502 12C16.4502 12.41 16.1102 12.75 15.7002 12.75Z" fill="currentColor"/>
                                    <path d="M14.7002 16.75H6.7002C6.2902 16.75 5.9502 16.41 5.9502 16C5.9502 15.59 6.2902 15.25 6.7002 15.25H14.7002C15.1102 15.25 15.4502 15.59 15.4502 16C15.4502 16.41 15.1102 16.75 14.7002 16.75Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <span>{{ __('Activity Log') }}</span>
                        </x-jet-nav-link>
                    </li>
                    @endhasrole
                </ul>
                @else
                    <ul class="flex flex-col space-y-2 sidebar-menu flex-grow">
                        <li>
                            <x-jet-nav-link href="{{ route('application.index', ['tab' => 'profile']) }}"
                                            :active="urlContains('profile')"
                                            class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                <div
                                    class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                    <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                        <path
                                            d="M9.88554 6.55229C10.3856 6.05219 10.6666 5.37391 10.6666 4.66667C10.6666 3.95942 10.3856 3.28115 9.88554 2.78105C9.38544 2.28095 8.70716 2 7.99992 2C7.29267 2 6.6144 2.28095 6.1143 2.78105C5.6142 3.28115 5.33325 3.95942 5.33325 4.66667C5.33325 5.37391 5.6142 6.05219 6.1143 6.55229C6.6144 7.05238 7.29267 7.33333 7.99992 7.33333C8.70716 7.33333 9.38544 7.05238 9.88554 6.55229Z"
                                            stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            d="M4.70009 10.7002C5.57526 9.825 6.76224 9.33333 7.99992 9.33333C9.2376 9.33333 10.4246 9.825 11.2998 10.7002C12.1749 11.5753 12.6666 12.7623 12.6666 14H3.33325C3.33325 12.7623 3.82492 11.5753 4.70009 10.7002Z"
                                            stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <span>{{ __('Profile') }}</span>
                            </x-jet-nav-link>
                        </li>
                        @if(auth()->user()->application_status->id() >= \App\Enums\ApplicationStatus::PROFILE_INFORMATION_COMPLETED->id())
                            <li>
                                <x-jet-nav-link href="{{ route('selection-test.index') }}"
                                                :active="request()->routeIs('selection-test.index')"
                                                class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                    <div
                                        class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                        <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                            <path
                                                d="M5.48533 6C5.85133 5.22333 6.83867 4.66667 8 4.66667C9.47333 4.66667 10.6667 5.562 10.6667 6.66667C10.6667 7.6 9.81467 8.38333 8.66267 8.60467C8.30133 8.674 8 8.96467 8 9.33333M8 11.3333H8.00667M14 8C14 8.78793 13.8448 9.56815 13.5433 10.2961C13.2417 11.0241 12.7998 11.6855 12.2426 12.2426C11.6855 12.7998 11.0241 13.2417 10.2961 13.5433C9.56815 13.8448 8.78793 14 8 14C7.21207 14 6.43185 13.8448 5.7039 13.5433C4.97595 13.2417 4.31451 12.7998 3.75736 12.2426C3.20021 11.6855 2.75825 11.0241 2.45672 10.2961C2.15519 9.56815 2 8.78793 2 8C2 6.4087 2.63214 4.88258 3.75736 3.75736C4.88258 2.63214 6.4087 2 8 2C9.5913 2 11.1174 2.63214 12.2426 3.75736C13.3679 4.88258 14 6.4087 14 8Z"
                                                stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span>{{ __('Selection tests') }}</span>
                                </x-jet-nav-link>
                            </li>
                        @endif

                        @if(auth()->user()->application_status->id() >= \App\Enums\ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON->id())
                            <li>
                                <x-jet-nav-link href="{{ route('application.index',['tab' => 'industries']) }}"
                                                :active="urlContains('industries') || urlContains('motivation') || urlContains('documents')"
                                                class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                    <div
                                        class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                        <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                            <path
                                                d="M8.63406 1.95134C8.43473 1.33734 7.56606 1.33734 7.36606 1.95134L6.3534 5.06734C6.30978 5.20111 6.22496 5.31765 6.11108 5.40028C5.9972 5.4829 5.8601 5.52738 5.7194 5.52735H2.4434C1.79806 5.52735 1.52873 6.35401 2.0514 6.73401L4.70206 8.65935C4.81593 8.74212 4.90066 8.85881 4.94414 8.9927C4.98761 9.12659 4.98758 9.2708 4.94406 9.40468L3.93206 12.5207C3.73206 13.1347 4.4354 13.646 4.9574 13.266L7.60806 11.3407C7.72199 11.2579 7.85922 11.2133 8.00006 11.2133C8.14091 11.2133 8.27814 11.2579 8.39206 11.3407L11.0427 13.266C11.5647 13.646 12.2681 13.1353 12.0681 12.5207L11.0561 9.40468C11.0125 9.2708 11.0125 9.12659 11.056 8.9927C11.0995 8.85881 11.1842 8.74212 11.2981 8.65935L13.9487 6.73401C14.4707 6.35401 14.2027 5.52735 13.5567 5.52735H10.2801C10.1395 5.52724 10.0025 5.4827 9.88878 5.40008C9.77503 5.31746 9.69031 5.201 9.64673 5.06734L8.63406 1.95134Z"
                                                stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span>{{ __('Application') }}</span>
                                </x-jet-nav-link>
                            </li>
                        @endif

                        @if(auth()->user()->application_status->id() >= \App\Enums\ApplicationStatus::PERSONAL_DATA_COMPLETED->id())
                            <li>
                                <x-jet-nav-link href="{{ route('companies.index') }}"
                                                :active="request()->routeIs('companies.index')"
                                                class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                    <div
                                        class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                        <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                            <path
                                                d="M5.48533 6C5.85133 5.22333 6.83867 4.66667 8 4.66667C9.47333 4.66667 10.6667 5.562 10.6667 6.66667C10.6667 7.6 9.81467 8.38333 8.66267 8.60467C8.30133 8.674 8 8.96467 8 9.33333M8 11.3333H8.00667M14 8C14 8.78793 13.8448 9.56815 13.5433 10.2961C13.2417 11.0241 12.7998 11.6855 12.2426 12.2426C11.6855 12.7998 11.0241 13.2417 10.2961 13.5433C9.56815 13.8448 8.78793 14 8 14C7.21207 14 6.43185 13.8448 5.7039 13.5433C4.97595 13.2417 4.31451 12.7998 3.75736 12.2426C3.20021 11.6855 2.75825 11.0241 2.45672 10.2961C2.15519 9.56815 2 8.78793 2 8C2 6.4087 2.63214 4.88258 3.75736 3.75736C4.88258 2.63214 6.4087 2 8 2C9.5913 2 11.1174 2.63214 12.2426 3.75736C13.3679 4.88258 14 6.4087 14 8Z"
                                                stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span>{{ __('Partner companies') }}</span>
                                </x-jet-nav-link>
                            </li>
                        @endif

                        <li>
                            <x-jet-nav-link href="{{ route('update-password') }}"
                                            :active="urlContains('update-password')"
                                            class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                <div
                                    class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                    <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M168 255.1C168 207.4 207.4 167.1 256 167.1C304.6 167.1 344 207.4 344 255.1C344 304.6 304.6 344 256 344C207.4 344 168 304.6 168 255.1zM256 199.1C225.1 199.1 200 225.1 200 255.1C200 286.9 225.1 311.1 256 311.1C286.9 311.1 312 286.9 312 255.1C312 225.1 286.9 199.1 256 199.1zM65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6V230.6zM158.4 129.2L145.1 139.5L77.13 117.8L46.89 170.2L99.58 218.2L97.39 234.8C96.47 241.7 96 248.8 96 255.1C96 263.2 96.47 270.3 97.39 277.2L99.58 293.8L46.89 341.8L77.13 394.2L145.1 372.5L158.4 382.8C169.5 391.4 181.9 398.6 195 403.1L210.5 410.4L225.8 480H286.2L301.5 410.4L316.1 403.1C330.1 398.6 342.5 391.4 353.6 382.8L366.9 372.5L434.9 394.2L465.1 341.8L412.4 293.8L414.6 277.2C415.5 270.3 416 263.2 416 256C416 248.8 415.5 241.7 414.6 234.8L412.4 218.2L465.1 170.2L434.9 117.8L366.9 139.5L353.6 129.2C342.5 120.6 330.1 113.4 316.1 108L301.5 101.6L286.2 32H225.8L210.5 101.6L195 108C181.9 113.4 169.5 120.6 158.4 129.2H158.4z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Update Password') }}</span>
                            </x-jet-nav-link>
                        </li>
                    </ul>
                    @endunlessrole

                    @role(ROLE_APPLICANT)
                    <ul>
                        <li>
                            <x-jet-nav-link href="{{ route('faq.index') }}"
                                            :active="urlContains('support')"
                                            class="w-full px-4 sm:py-2 text-primary space-x-2 hover:bg-primary hover:text-white">
                                <div
                                    class="icon w-8 h-8 bg-primary bg-opacity-0 flex items-center justify-center rounded-full">
                                    <svg viewBox="0 0 16 16" fill="none" class="w-5 h-5">
                                        <path
                                            d="M2 5.33333L7.26 8.84C7.47911 8.98618 7.7366 9.06419 8 9.06419C8.2634 9.06419 8.52089 8.98618 8.74 8.84L14 5.33333M3.33333 12.6667H12.6667C13.0203 12.6667 13.3594 12.5262 13.6095 12.2761C13.8595 12.0261 14 11.687 14 11.3333V4.66666C14 4.31304 13.8595 3.9739 13.6095 3.72385C13.3594 3.4738 13.0203 3.33333 12.6667 3.33333H3.33333C2.97971 3.33333 2.64057 3.4738 2.39052 3.72385C2.14048 3.9739 2 4.31304 2 4.66666V11.3333C2 11.687 2.14048 12.0261 2.39052 12.2761C2.64057 12.5262 2.97971 12.6667 3.33333 12.6667Z"
                                            stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <span>{{ __('Support') }}</span>
                            </x-jet-nav-link>
                        </li>
                    </ul>

                    @if (!in_array(auth()->user()->application_status, [\App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_NAK, \App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT]))
                        <x-danger-button class=" mr-auto ml-4 mt-4"
                                         data-tippy-content="{{__('Cancel application (your data will be deleted)')}}"
                                         onclick="Livewire.emit('ApplicationReject.modal.toggle', {{ auth()->user() }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-slash">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                            </svg>
                        </x-danger-button>
                        <livewire:application-reject/>
                        @endrole
                        @endrole
            </div>
        </div>
    </div>
</nav>
