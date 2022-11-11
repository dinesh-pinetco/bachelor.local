<div class="py-4 sm:mr-auto px-6 2xl:px-10 flex-shrink-0 flex items-center justify-start">
    <a href="{{ (auth()->user() && auth()->user()->hasRole(ROLE_APPLICANT))?route('dashboard'):route('employee.dashboard') }}"
       class="inline-block w-full">
        <x-jet-application-mark class="block h-9 w-auto mr-auto"/>
    </a>
</div>
