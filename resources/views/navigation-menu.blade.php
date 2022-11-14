<nav x-data="{ open: false }" class="min-h-screen shadow-xl relative z-50 bg-white overflow-y-auto">
    <!-- Primary Navigation Menu -->
    <div class="py-4 md:py-6 h-full">
        <div class="flex flex-col justify-between">
            <div class="flex flex-col">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center mb-5 px-4">
                    <a href="{{ auth()->user()->hasRole(ROLE_APPLICANT)?route('dashboard'):route('employee.dashboard') }}"
                       class="inline-block w-full">
                        <x-jet-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>
                <!-- Navigation Links for Applicant -->
                @unlessrole(ROLE_APPLICANT)
                <ul class="flex flex-col space-y-2 sidebar-menu">
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
                                            :active="request()->routeIs('admin.employee.index')"
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
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 640 512">
                                    <path
                                            d="M160 320c53.02 0 96-42.98 96-96c0-53.02-42.98-96-96-96C106.1 128 64 170.1 64 224C64 277 106.1 320 160 320zM160 160c35.29 0 64 28.71 64 64S195.3 288 160 288S96 259.3 96 224S124.7 160 160 160zM192 352H128c-70.69 0-128 57.31-128 128c0 17.67 14.33 32 32 32h256c17.67 0 32-14.33 32-32C320 409.3 262.7 352 192 352zM32 480c0-52.94 43.07-96 96-96h64c52.94 0 96 43.06 96 96H32zM592 0h-384C181.5 0 160 21.53 160 48v32C160 88.84 167.2 96 176 96S192 88.84 192 80v-32C192 39.19 199.2 32 208 32h384C600.8 32 608 39.19 608 48v320c0 8.812-7.172 16-16 16H576v-48C576 309.5 554.5 288 528 288h-96C405.5 288 384 309.5 384 336V384h-32c-8.844 0-16 7.156-16 16S343.2 416 352 416h240C618.5 416 640 394.5 640 368v-320C640 21.53 618.5 0 592 0zM544 384h-128v-48c0-8.812 7.172-16 16-16h96c8.828 0 16 7.188 16 16V384z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Applicants') }}</span>
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
                                            :active="request()->routeIs('employee.settings.fields.*')"
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span>{{ __('Activity Log') }}</span>
                            </x-jet-nav-link>
                        </li>
                    @endhasrole
                </ul>
                @endunlessrole

                @role(ROLE_APPLICANT)
                @if (!in_array(auth()->user()->application_status, [\App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_NAK, \App\Enums\ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT]))
                    <x-danger-button
                        onclick="Livewire.emit('ApplicationReject.modal.toggle', {{ auth()->user() }})">
                        {{ __('cancel') }}
                    </x-danger-button>
                    <livewire:application-reject/>
                    @endrole
                    @endrole
            </div>
        </div>
    </div>
</nav>
