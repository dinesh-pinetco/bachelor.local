<div>
    <div class="w-full max-w-screen-xl mx-auto lg:pl-40 2xl:pl-64">

        <div class="flex-grow flex flex-col flex-wrap text-primary relative">
            <p>
                {{ __("You've almost made it, now all you have to do is choose one or more partner companies where you would like to apply for a position as a dual student.") }}
            </p>
            <p class="mt-4">
                {{ __("You can also unlock yourself for our applicant marketplace. This will make you visible to ALL companies, so that they can approach you if necessary (no guarantee, so make sure to apply yourself):") }}
            </p>
            <div>
                <x-primary-button type="button" wire:click="selectCompany" class="mr-2">
                    {{ __('Apply directly to selected company') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
