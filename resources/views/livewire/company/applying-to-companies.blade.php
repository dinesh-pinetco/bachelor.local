<div>
    <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">
        @if ($showTextarea)
            <div
                class="flex flex-wrap xl:flex-nowrap w-full gap-10 xl:gap-6">
                <div class="w-full xl:w-2/3 flex-shrink-0 h-full overflow-y-auto px-2 -mx-2">
                    <div class="flex items-start space-x-2 mt-5">
                        <label for="is_see_test_results" class="flex cursor-pointer items-center mb-0">
                            <input
                                id="is_see_test_results"
                                wire:model="is_see_test_results"
                                type="checkbox"
                                class="flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary">
                            <span class="checkbox-label flex-grow pl-2">
                                            {{ __('Selected companies can see the test results') }}
                                        </span>
                        </label>
                    </div>
                    <x-primary-button type="button" wire:click="applyToSelectedCompany">
                        {{ __('Apply to Selected Company') }}
                    </x-primary-button>
                </div>
                <div class="w-full xl:w-1/3 flex-shrink-0 h-full overflow-y-auto">
                    <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                        {{__('Selected companies')}}
                    </h6>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($this->companies->whereIn('id', $selectedCompanyIds) as $selectedCompany)
                            <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm">
                                {{ $selectedCompany->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-wrap items-start justify-between gap-5 max-w-4xl h-full">
                <div class="flex flex-wrap gap-2 md:gap-4">
                    <x-jet-input class="w-full md:w-auto" wire:model='search'
                                 placeholder="{{ __('Search by name') }}"/>
                    <x-jet-input class="w-full md:w-auto" wire:model='zip_code'
                                 placeholder="{{ __('Search by zip code') }}"/>
                    <x-primary-button class="-mt-0" wire:click="next">{{ __('Apply now') }}</x-primary-button>
                </div>
                <div class="flex flex-wrap md:flex-nowrap w-full gap-10 md:gap-6">
                    <div class="w-full md:w-1/2 flex-shrink-0 h-full overflow-y-auto">
                        <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                            {{__('Company list')}}
                        </h6>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse ($this->filteredCompanies as $company)
                                <div class="flex items-center gap-2 py-1">
                                    <input
                                        class="m-1 flex-shrink-0 w-5 h-5 form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none text-primary"
                                        type="checkbox"
                                        id="{{ $company->id }}"
                                        wire:model="selectedCompanyIds.{{ $company->id }}"
                                        value="{{ $company->id }}">
                                    <label class="mb-0 cursor-pointer text-sm"
                                           for="{{ $company->id }}"> {{ ($company->name) }}</label>
                                </div>
                            @empty
                                <p class="text-sm text-darkgray">{{__('No Company Found')}}</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 flex-shrink-0 h-full overflow-y-auto">
                        <h6 class="text-lg lg:text-2xl font-medium text-primary mb-3 md:mb-5">
                            {{__('Selected companies')}}
                        </h6>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($companies->whereIn('id', $selectedCompanyIds) as $selectedCompany)
                                <div class="text-xs py-2 px-4 bg-primary bg-opacity-10 rounded-sm">
                                    {{ $selectedCompany->name }}
                                </div>
                            @empty
                                <p class="text-sm text-darkgray">{{__('please select the companies')}}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
