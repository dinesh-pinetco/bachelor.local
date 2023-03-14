<div
    class="flex flex-wrap pb-10 {{ $isProfile ?? '' ? 'max-w-screen-xl mx-auto' : '' }}">
    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>

    <div class="flex-grow w-1/3">
        <div class="flex flex-wrap justify-between items-center mb-6 md:mb-12">
            <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight mb-4 md:mb-0">
                {{ __('Application') }}
            </h2>
            <x-link-button :active="true"
                           href="#"
                           class="flex justify-end mt-4 md:mb-0 -mt-0">
                {{ __('Verify to Selection Test') }}
            </x-link-button>
        </div>

        <ul class="flex space-x-4 tabs overflow-x-auto">
            @foreach($tabs as $tab)
                <li>
                    @role(ROLE_APPLICANT)
                        <x-jet-nav-link href="{{ route('application.index', ['tab' => $tab->slug]) }}"
                                        :active="urlContains($tab->slug)"
                                        class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm"
                        >
                            {{ __($tab->name) }}
                        </x-jet-nav-link>
                    @elserole
                        <x-jet-nav-link
                            href="{{ route('employee.applicants.edit', ['slug' => $tab->slug, 'applicant' => $applicant]) }}"
                            :active="urlContains($tab->slug)"
                            class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm"
                        >
                            {{ __($tab->name) }}
                        </x-jet-nav-link>
                    @endrole
                </li>
            @endforeach
            @role(ROLE_APPLICANT)
                <li>
                    <x-jet-nav-link href="{{ route('documents.index') }}" :active="urlContains('documents')"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __('Documents') }}
                    </x-jet-nav-link>
                </li>
            @elserole
                <li>
                    <x-jet-nav-link :active="urlContains('documents')"
                                    href="{{ route('employee.applicants.edit', ['slug' => 'documents', 'applicant' => $applicant]) }}"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __('Documents') }}
                    </x-jet-nav-link>
                </li>
                <li>
                    <x-jet-nav-link :active="urlContains('selection-test')"
                                    href="{{ route('employee.selection-tests.index', ['applicant' => $applicant]) }}"
                                    class="flex-shrink-0 whitespace-nowrap px-4 py-2 text-base bg-lightgray hover:bg-primary text-primary hover:text-lightgray leading-snug transition duration-200 ease-in-out rounded-sm">
                        {{ __('Selection Test') }}
                    </x-jet-nav-link>
                </li>
            @endrole
        </ul>
    </div>
</div>
