<x-app-layout>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div class="mb-4 md:mb-7">
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{__('Hello,') }} {{ auth()->user()->full_name }}!
            </h1>
            <h6 class="text-base md:text-xl font-medium text-primary">
                {{__('Your next steps')}}
            </h6>
        </div>
        <livewire:employee.statistics />
    </div>
</x-app-layout>
