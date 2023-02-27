@php use App\Models\StudySheet; @endphp
<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto h-full">
        <div>
            <div class="md:-mx-4">
                <div class="mt-5 md:mt-0 md:px-4 w-full md:w-1/2 mx-auto space-y-2">
                    <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('Study Sheet') }}</h2>
                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                        {{ __('This information will be shared with staff members of the Nordakademie. Please check the information for accuracy.') }}
                    </p>
                </div>
                <div class="mt-8 md:px-4 w-full md:w-1/2 mx-auto">
                    @if (!$studySheet->is_submit)
                        <form wire:submit.prevent="submit" id="courseForm">
                            <div class="space-y-10">
                                <div class="space-y-4">
                                    <div>
                                        <x-jet-label for="coursesNames" class="block required">
                                            {{ __('Degree') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full text-gray cursor-not-allowed" type="text"
                                                     disabled="true"
                                                     wire:model.lazy="coursesNames"
                                                     id="coursesNames" min="10"
                                                     max="10"></x-jet-input>
                                    </div>
                                    <div>
                                        <x-jet-label for="desiredBeginning" class="block required">
                                            {{ __('Start of studies') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                     disabled="true"
                                                     wire:model.lazy="desiredBeginning"
                                                     id="desiredBeginning" min="10"
                                                     max="10"></x-jet-input>
                                    </div>
                                    <div>
                                        <x-jet-label for="firstName" class="block required">
                                            {{ __('First name') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                     disabled="true"
                                                     wire:model.lazy="firstName"
                                                     id="firstName" min="10"
                                                     max="10"></x-jet-input>
                                    </div>

                                    <div>
                                        <x-jet-label for="lastName" class="block required">
                                            {{ __('Last name') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                     disabled="true"
                                                     wire:model.lazy="lastName"
                                                     id="lastName" min="10"
                                                     max="10"></x-jet-input>
                                    </div>
                                    <div>
                                        <x-jet-label for="date_of_birth" class="block required">
                                            {{ __('Date of Birth') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full " type="date"
                                                     :placeholder="__('Date of Birth')"
                                                     wire:model.lazy="studySheet.date_of_birth"
                                                     id="date_of_birth" min="10"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.date_of_birth"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="place_of_birth" class="block required">
                                            {{ __('place of birth ') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="text"
                                                     :placeholder="__('place of birth ')"
                                                     wire:model.lazy="studySheet.place_of_birth"
                                                     id="place_of_birth"
                                                     max="10"></x-jet-input>
                                        <x-jet-input-error for="studySheet.place_of_birth"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="country_of_birth" class="block required">
                                            {{ __('Country of birth') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="text"
                                                     :placeholder="__('Country of birth')"
                                                     wire:model.lazy="studySheet.country_of_birth"
                                                     id="country_of_birth"
                                                     max="10"></x-jet-input>
                                        <x-jet-input-error for="studySheet.country_of_birth"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="nationality_first" class="block required">
                                            {{ __('Nationality first') }}
                                        </x-jet-label>
                                        <x-livewire-select id="nationality_first"
                                                           name="nationality_first"
                                                           model="studySheet.nationality_first"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.nationality_first"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="nationality_second" class="block">
                                            {{ __('Nationality second') }}
                                        </x-jet-label>
                                        <x-livewire-select id="nationality_second"
                                                           name="nationality_second"
                                                           model="studySheet.nationality_second"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.nationality_second"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active"
                                                     class="block required">{{ __('Student card photo') }}</x-jet-label>
                                        <div class="flex flex-col items-start">
                                            @if(!is_null($studySheet->student_id_card_photo) && !$errors->has('studySheet.student_id_card_photo'))
                                                <div
                                                    class="mb-4 overflow-hidden shadow w-28 h-28 xl:w-36 xl:h-36">
                                                    <img
                                                        class="object-cover object-center w-full h-full"
                                                        src="{{ $studySheet->student_id_card_photo_url }}"
                                                        alt="{{ $studySheet->student_id_card_photo }}">
                                                </div>
                                            @endif

                                            <div>
                                                <label
                                                    class="inline-block cursor-pointer px-4 py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out">
                                                    <span class="xl:text-lg"><i class="fal fa-edit"></i></span>
                                                    <span class="ml-1">{{ __('Choose Photo') }}</span>
                                                    <input type="file"
                                                           class="hidden"
                                                           wire:model="studySheet.student_id_card_photo"
                                                           name="student_id_card_photo"
                                                           accept="image/png, image/jpg, image/jpeg"
                                                    >
                                                </label>
                                            </div>
                                            <!-- Remove Button Start -->
                                            @if(!is_null($studySheet->student_id_card_photo) && !$errors->has('studySheet.student_id_card_photo'))
                                                <a href="javascript:void(0)"
                                                   wire:click="deletePhoto"
                                                   class="inline-block px-4 cursor-pointer py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out">
                                                    <span class="xl:text-lg"><i class="fal fa-trash-alt"></i></span>
                                                    <span class="ml-1">{{ __('Remove Photo') }}</span>
                                                </a>
                                            @endif
                                            <!-- Remove Button End -->
                                        </div>
                                        <x-jet-input-error for="studySheet.student_id_card_photo"
                                                           class="mt-2 text-red"/>
                                    </div>

                                    <input type="checkbox" wire:model="studySheet.have_health_insurance"
                                           id="do_you_health_insurance">
                                    <label
                                        for="do_you_health_insurance">{{__('Do you have information about your health insurance?')}}</label>
                                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                                        {{ __('If your insurance information is available for your health insurance company, enter it here. Enrollment is only possible after the data on your health insurance status has been entered and checked. Therefore, this data should be added here as soon as you have it.') }}
                                    </p>


                                    @if($studySheet->have_health_insurance)

                                        <input type="checkbox" wire:model="studySheet.is_health_insurance_private"
                                               id="is_health_insurance_private">
                                        <label
                                            for="is_health_insurance_private">{{ __('Private health insurance?') }}</label>
                                        @if(!$studySheet->is_health_insurance_private)
                                            <div>
                                                <x-jet-label for="is_active" class="block required">
                                                    {{ __('Health insurance') }}
                                                </x-jet-label>
                                                <x-livewire-select id="is_active" name="is_active"
                                                                   model="studySheet.health_insurance_company_id"
                                                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option value=""> {{ __('Please select') }}</option>
                                                    @foreach ($this->healthInsuranceCompanies as $healthInsuranceCompany)
                                                        <option value="{{ $healthInsuranceCompany->id }}">
                                                            {{ $healthInsuranceCompany->short_description }}
                                                        </option>
                                                    @endforeach
                                                </x-livewire-select>
                                                <x-jet-input-error for="studySheet.health_insurance_company_id"/>
                                            </div>

                                            <div>
                                                <x-jet-label for="health_insurance_number" class="block required">
                                                    {{ __('Health insurance number') }}
                                                </x-jet-label>
                                                <x-jet-input class="w-full" type="text"
                                                             :placeholder="__('Enter health insurance number')"
                                                             wire:model.lazy="studySheet.health_insurance_number"
                                                             id="health_insurance_number" min="10"
                                                             max="10"></x-jet-input>
                                                <x-jet-input-error for="studySheet.health_insurance_number"/>

                                            </div>
                                        @endif
                                    @endif

                                    <div>
                                        <x-jet-label for="school" class="block">
                                            {{ __('School') }}({{ __('When in list') }})
                                        </x-jet-label>
                                        <x-livewire-select id="school" name="school"
                                                           model="studySheet.school"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">
                                                    {{ $school->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="studySheet.school"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="phone"
                                                     class="block required">
                                            {{ __('Phone') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full"
                                            type="text"
                                            :placeholder="__('Phone')"
                                            wire:model.lazy="studySheet.phone"
                                            id="phone"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.phone"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="email"
                                                     class="block required">
                                            {{ __('Email') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full cursor-not-allowed"
                                            type="text"
                                            disabled="true"
                                            :placeholder="__('Email')"
                                            wire:model.lazy="email"
                                            id="email"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.email"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="address"
                                                     class="block">
                                            {{ __('address supplement') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full"
                                            type="text"
                                            :placeholder="__('address supplement')"
                                            wire:model.lazy="studySheet.address"
                                            id="address"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.address"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="street"
                                                     class="block required">
                                            {{ __('Street') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full"
                                            type="text"
                                            :placeholder="__('Street')"
                                            wire:model.lazy="studySheet.street"
                                            id="street"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.street"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="zip"
                                                     class="block required">
                                            {{ __('Zip') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full"
                                            type="text"
                                            :placeholder="__('Zip')"
                                            wire:model.lazy="studySheet.zip"
                                            id="zip"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.zip"/>
                                    </div>
                                    <div>
                                        <x-jet-label for="place"
                                                     class="block required">
                                            {{ __('Place') }}
                                        </x-jet-label>
                                        <x-jet-input
                                            class="w-full"
                                            type="text"
                                            :placeholder="__('Place')"
                                            wire:model.lazy="studySheet.place"
                                            id="zip"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.place"/>
                                    </div>

                                    <div class="">
                                        <div class="flex form-check flex space-x-4">
                                            <input wire:model.lazy="studySheet.is_authorize"
                                                   id="studySheet.is_authorize"
                                                   class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                                   type="checkbox">
                                            <label class="form-check-label inline-block text-gray-800"
                                                   for="studySheet.is_authorize">
                                                {{ __('study sheet is authorize') }}
                                            </label>
                                        </div>
                                        <x-jet-input-error for="studySheet.is_authorize"/>
                                    </div>

                                    <div class="mb-7">
                                        <div class="flex form-check flex space-x-4">
                                            <input wire:model.lazy="studySheet.privacy_policy"
                                                   id="studySheet.privacy_policy"
                                                   class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                                   type="checkbox">
                                            <label class="form-check-label inline-block text-gray-800"
                                                   for="studySheet.privacy_policy">
                                                {{ __('study sheet privacy policy') }}
                                            </label>
                                        </div>
                                        <x-jet-input-error for="studySheet.privacy_policy"/>
                                    </div>
                                </div>

                                <div class="py-3 text-right">
                                    <x-primary-button type="submit" class="">
                                        {{ __('Save') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div>
                            <p class="mt-2 text-darkblack">
                                {{ $formAlreadySubmitted ? __('Your form already submitted successfully.') : __('Your form submitted successfully.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>