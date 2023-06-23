<div>
        <div class="xl:px-20 w-full max-w-screen-xl mx-auto h-full">
            <div>
                <div class="md:-mx-4">
                    <div class="mt-5 md:mt-0 md:px-4 w-full md:w-1/2 mx-auto space-y-2">
                        <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                            {{ __('Study Sheet') }}</h2>
                        @role(ROLE_APPLICANT)
                            <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                                {{ __('This information will be shared with staff members of the Nordakademie. Please check the information for accuracy.') }}
                            </p>
                        @endrole
                    </div>
                    <div class="mt-8 md:px-4 w-full md:w-1/2 mx-auto">
                        @if (!$showThanks)
                            <form wire:submit.prevent="submit" id="courseForm">
                                <div class="space-y-10">
                                    <div class="space-y-4">
                                        <div>
                                            <x-jet-label for="courseName" class="block required">
                                                {{ __('Degree') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full text-gray cursor-not-allowed" type="text"
                                                        disabled="true"
                                                        wire:model.lazy="courseName"
                                                        id="courseName"
                                            ></x-jet-input>
                                        </div>
                                        <div>
                                            <x-jet-label for="desiredBeginning" class="block required">
                                                {{ __('Start of studies') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                        disabled="true"
                                                        wire:model.lazy="desiredBeginning"
                                                        id="desiredBeginning"></x-jet-input>
                                        </div>
                                        <div>
                                            <x-jet-label for="firstName" class="block required">
                                                {{ __('First name') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                        disabled="true"
                                                        wire:model.lazy="firstName"
                                                        id="firstName"
                                            ></x-jet-input>
                                        </div>

                                        <div>
                                            <x-jet-label for="lastName" class="block required">
                                                {{ __('Last name') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                        disabled="true"
                                                        wire:model.lazy="lastName"
                                                        id="lastName"
                                            ></x-jet-input>
                                        </div>
                                        <div>
                                            <x-jet-label for="date_of_birth" class="block required">
                                                {{ __('Date of Birth') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full cursor-not-allowed" type="text"
                                                        disabled="true"
                                                        :placeholder="__('Date of Birth')"
                                                        wire:model.lazy="dateOfBirth"
                                                        id="date_of_birth"
                                            ></x-jet-input>
                                            <x-jet-input-error for="studySheet.date_of_birth"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="place_of_birth" class="block required">
                                                {{ __('place of birth') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full {{ $isEdit ? 'cursor-auto' : 'cursor-not-allowed' }}" type="text"
                                                        :placeholder="__('place of birth')"
                                                        :disabled="!$isEdit"
                                                        wire:model.lazy="studySheet.place_of_birth"
                                                        id="place_of_birth"
                                            ></x-jet-input>
                                            <x-jet-input-error for="studySheet.place_of_birth"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="country_of_birth" class="block required">
                                                {{ __('Country of birth') }}
                                            </x-jet-label>
                                            <x-jet-input class="w-full {{ $isEdit ? 'cursor-auto' : 'cursor-not-allowed' }}" type="text"
                                                        :placeholder="__('Country of birth')"
                                                        :disabled="!$isEdit"
                                                        wire:model.lazy="studySheet.country_of_birth"
                                                        id="country_of_birth"
                                            ></x-jet-input>
                                            <x-jet-input-error for="studySheet.country_of_birth"/>
                                        </div>
                                        <div>
                                            <x-jet-label for="nationality_first" class="block required">
                                                {{ __('Nationality first') }}
                                            </x-jet-label>
                                            <x-livewire-select id="nationality_first"
                                                            name="nationality_first"
                                                            model="studySheet.nationality_first"
                                                            :isEdit="$isEdit"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
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
                                                            :isEdit="$isEdit"
                                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
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
                                                            class="object-cover object-center w-full h-full {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                                            src="{{ $studySheet->student_id_card_photo_url }}"
                                                            alt="{{ $studySheet->student_id_card_photo }}">
                                                    </div>
                                                @endif

                                                <div>
                                                    <label
                                                        class="inline-block cursor-pointer px-4 py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                                                        <span class="xl:text-lg"><i class="fal fa-edit"></i></span>
                                                        <span class="ml-1 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">{{ __('Choose Photo') }}</span>
                                                        <input type="file"
                                                            class="hidden {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                                            wire:model="studySheet.student_id_card_photo"
                                                            {{ $isEdit ? '' : 'disabled' }}
                                                            name="student_id_card_photo"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                        >
                                                    </label>
                                                </div>
                                                <!-- Remove Button Start -->
                                                @if(!is_null($studySheet->student_id_card_photo) && !$errors->has('studySheet.student_id_card_photo'))
                                                    <button
                                                    {{ $isEdit ? '' : 'disabled' }}
                                                    wire:click="deletePhoto"
                                                    class="inline-block px-4 cursor-pointer py-2 bg-primary border border-transparent rounded-sm font-semibold text-base text-white hover:bg-opacity-90 focus:outline-none focus:bg-opacity-90 disabled:opacity-25 transition mt-4 duration-150 ease-in-out {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                                                        <span class="xl:text-lg"><i class="fal fa-trash-alt"></i></span>
                                                        <span class="ml-1">{{ __('Remove Photo') }}</span>
                                                    </button>
                                                @endif
                                                <!-- Remove Button End -->
                                            </div>
                                            <x-jet-input-error for="studySheet.student_id_card_photo"
                                                            class="mt-2 text-red"/>
                                        </div>

                                        <div class="mb-7">
                                            <div class="flex form-check flex space-x-4">
                                                <input wire:model="studySheet.have_health_insurance"
                                                    id="do_you_health_insurance"
                                                    {{ $isEdit ? '' : 'disabled' }}
                                                    class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                                    type="checkbox">
                                                <label class="form-check-label inline-block text-gray-800"
                                                    for="do_you_health_insurance">
                                                    {{ __('Do you have information about your health insurance?') }}
                                                </label>
                                            </div>
                                        </div>
                                        <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                                            {{ __('If your insurance information is available for your health insurance company, enter it here. Enrollment is only possible after the data on your health insurance status has been entered and checked. Therefore, this data should be added here as soon as you have it.') }}
                                        </p>


                                        @if($studySheet->have_health_insurance)

                                            <div class="mb-7">
                                                <div class="flex items-center form-check flex space-x-4">
                                                    <input wire:model="studySheet.is_health_insurance_private"
                                                        id="is_health_insurance_private"
                                                        {{ $isEdit ? '' : 'disabled' }}
                                                        class="flex-shrink-0 w-5 h-5 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                                        type="checkbox">
                                                    <label class="form-check-label inline-block text-gray-800 mb-0"
                                                        for="is_health_insurance_private">
                                                        {{ __('Private health insurance?') }}
                                                    </label>
                                                </div>
                                            </div>
                                            @if(!$studySheet->is_health_insurance_private)
                                                <div>
                                                    <x-jet-label for="is_active" class="block required">
                                                        {{ __('Health insurance') }}
                                                    </x-jet-label>
                                                    <x-livewire-select id="is_active" name="is_active"
                                                                    model="studySheet.health_insurance_company_id"
                                                                    :isEdit="$isEdit"
                                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
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
                                                    <x-jet-input class="w-full {{ $isEdit ? 'cursor-text' : 'cursor-not-allowed' }}" type="text"
                                                                :placeholder="__('Enter health insurance number')"
                                                                :disabled="!$isEdit"
                                                                wire:model.lazy="studySheet.health_insurance_number"
                                                                id="health_insurance_number"
                                                    ></x-jet-input>
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
                                                           :isEdit="$isEdit"
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
                                    <div wire:ignore>
                                        <x-jet-label for="phone"
                                                     class="block required">
                                            {{ __('Phone') }}
                                        </x-jet-label>
                                        <x-input-tel wire:model="studySheet.phone"
                                                     value="{{ $studySheet->phone }}"
                                                     class="w-full h-11 py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none rounded-sm text-sm md:text-base text-primary placeholder-gray {{ $isEdit ? 'cursor-default' : 'cursor-not-allowed' }}"
                                                     placeholder="{{ __('Enter phone number') }}"
                                        />

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
                                            class="w-full {{ $isEdit ? 'cursor-text' : 'cursor-not-allowed' }}"
                                            type="text"
                                            :placeholder="__('address supplement')"
                                            wire:model.lazy="studySheet.address"
                                            :disabled="!$isEdit"
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
                                            class="w-full {{ $isEdit ? 'cursor-text' : 'cursor-not-allowed' }}"
                                            type="text"
                                            :placeholder="__('Street')"
                                            wire:model.lazy="studySheet.street"
                                            :disabled="!$isEdit"
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
                                            class="w-full {{ $isEdit ? 'cursor-text' : 'cursor-not-allowed' }}"
                                            type="text"
                                            :placeholder="__('Zip')"
                                            wire:model.lazy="studySheet.zip"
                                            :disabled="!$isEdit"
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
                                            class="w-full {{ $isEdit ? 'cursor-text' : 'cursor-not-allowed' }}"
                                            type="text"
                                            :placeholder="__('Place')"
                                            wire:model.lazy="studySheet.place"
                                            :disabled="!$isEdit"
                                            id="place"
                                        ></x-jet-input>
                                        <x-jet-input-error for="studySheet.place"/>
                                    </div>
                                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                                        {{ __('If your insurance information is available for your health insurance company, enter it here. Enrollment is only possible after the data on your health insurance status has been entered and checked. Therefore, this data should be added here as soon as you have it.') }}
                                    </p>

                                    <p class="text-sm py-4 bg-opacity-25">
                                        {{ __('Spanish and French can be taken as beginners (no previous knowledge) or as advanced (2-3 years previous knowledge). Based on a placement test, homogeneous teaching groups are formed according to individual language skills.') }}

                                    <div>
                                        <x-jet-label for="secondary_language" class="block">
                                            {{ __('Please choose your 2nd foreign language') }}
                                        </x-jet-label>
                                        <x-livewire-select id="secondary_language" name="secondary_language"
                                                           model="studySheet.secondary_language"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $isEdit ? 'cursor-default' : 'cursor-not-allowed' }}">
                                            <option value=""> {{ __('Please select a language') }}</option>
                                            <option value="fr">{{__('Französisch')}}</option>
                                            <option value="es">{{__('Spanisch')}}</option>
                                        </x-livewire-select>
                                    </div>

                                    <h6 class="mb-5 md:mb-9 text-primary text-xl font-medium leading-tight">
                                        {{ __('Alumni Network Nordakademiker e.V.') }}</h6>
                                    <p class="text-sm py-4 bg-opacity-25">
                                        {{ __('Ein Studium an der NORDAKADEMIE verbindet nicht nur für die Studienzeit, sondern auch nach dem Abschluss. Als Mitglied der offiziellen Alumni-Organisation der NORDAKADEMIE, dem Nordakademiker e. V., heißt es miteinander in Verbindung bleiben, um gemeinsam zu wachsen und voneinander zu lernen. Der Verein wurde bereits 1993 von Studierenden gegründet und steht seitdem in engem Kontakt zu seiner Hochschule. Der Nordakademiker e. V. bietet neben einem Netzwerk aus weltweit 3.000 Alumni und Studierenden der NORDAKADEMIE ein breites Spektrum attraktiver Leistungen über Expertenvorträge, Zugang zu Fachzeitschriften oder Mentoring- Programmen - nicht nur für Alumni sondern beitragsfrei auch für aktiv Studierende.') }}
                                    </p>
                                    <p class="text-sm py-4 bg-opacity-25">
                                        {{ __('Your consent is required for us to transfer your contact data to the alumni network Nordakademiker e. V. (Köllner Chaussee 11, 25337 Elmshorn) and for Nordakademiker e. V. to use the contact data for the purposes described below (Art. 6 Para. 1 lit. a DSGVO). Your consent is required for us to transfer your contact data to the alumni network Nordakademiker e. V. (Köllner Chaussee 11, 25337 Elmshorn) and for Nordakademiker e. V. to use the contact data for the purposes described below (Art. 6 para. 1 lit. a DSGVO).') }}
                                    </p>
                                    <p class="text-sm py-4 bg-opacity-25">
                                        {{ __('The subject of the transmission are the following personal data: First and last name, address, e-mail address and the study number') }}
                                    </p>
                                    <p class="text-sm py-4 bg-opacity-25">
                                        {{ __('The alumni network Nordakademiker e. V. uses the personal data mentioned for the following purposes: To provide information about the alumni network Nordakademiker e. V. as well as its members, especially about events (e.g. professional events or company visits etc.) or other actions relevant to you.') }}
                                    </p>
                                    <p class="text-sm py-4 bg-opacity-25">
                                        <span>{{ __('Consent to the specific use described above is voluntary and, if granted, may be given to NORDAKADEMIE at any time under the link') }} </span><a href="https://nordakademiker.de/privacy/" class="text-primary underline font-black">https://nordakademiker.de/privacy/</a> <span>{{ __('freely revocable without giving reasons with effect for the future.') }}</span>
                                    </p>


                                    <div class="">

                                    <div class="mb-7">
                                        <div class="flex form-check flex space-x-4">
                                            <input wire:model.lazy="studySheet.privacy_policy"
                                                   {{ $isEdit ? '' : 'disabled' }}
                                                   id="studySheet.privacy_policy"
                                                   class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none {{ $isEdit ? 'cursor-default' : 'cursor-not-allowed' }}"
                                                   type="checkbox">
                                            <label class="form-check-label inline-block text-gray-800 {{ $isEdit ? 'cursor-default' : 'cursor-not-allowed' }}"
                                                   for="studySheet.privacy_policy">
                                                <span>{{ __('I agree that NORDAKADEMIE may transfer my contact details to the alumni network Nordakademiker e. V. as described above and that Nordakademiker e. V. may use the contact details for the purposes described. General information on data protection can be found at') }}</span> <a href="https://www.nordakademie.de/datenschutz/" class="text-primary underline font-black">https://www.nordakademie.de/datenschutz/</a> <span>{{ __('bzw.') }}</span> <a href="https://nordakademiker.de/privacy/" class="text-primary underline font-black"> https://nordakademiker.de/privacy/</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        @if($errors->any())
                                            <span class="text-red">{{ __('Please complete all required fields.') }}</span>
                                        @endif
                                    </div>

                                    @if(! $formAlreadySubmitted)
                                        <div class="py-3 text-right">
                                            <x-primary-button type="submit" class="{{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                                                {{ __('Save') }}
                                            </x-primary-button>
                                        </div>
                                    @endif
                                    </div>

                                </div>
                            </form>
                        @else
                            <div>
                                @role(ROLE_APPLICANT)
                                    <p class="mt-2 text-darkblack">
                                        {{ $formAlreadySubmitted ? __('Your form already submitted successfully.') : __('Your form submitted successfully.') }}
                                    </p>
                                @endrole
                                <button class="mt-2 bg-darkgreen text-white px-4 py-2 underline" wire:click="$set('showThanks', false)" wire:loading.class="cursor-wait" >{{ __('Edit') }}</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>
