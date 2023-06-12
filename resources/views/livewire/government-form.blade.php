<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto h-full">
        <div>
            <div class="md:-mx-4">
                <div class="mt-5 md:mt-0 md:px-4 w-full md:w-1/2 mx-auto space-y-2">
                    <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                        {{ __('State Statistical Office') }}</h2>
                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                        {{ __('Data is already available, but you are welcome to correct it.') }}
                    </p>
                    <p class="text-sm text-primary p-4 bg-primary-light bg-opacity-25">
                        {{ __('NORDAKADEMIE is required by high school law to transmit the following data to the State Statistics Office.') }}
                    </p>
                </div>
                <div class="mt-8 md:px-4 w-full md:w-1/2 mx-auto">
                    @if (!$showThanks)
                        <form wire:submit.prevent="submit" id="courseForm">
                            <div class="space-y-10">
                                <div class="space-y-4">
                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('General Information') }}</h5>
                                    <div>
                                        <x-jet-label for="country_id" class="block required">
                                            {{ __('Nationality, if German with additional nationality please select German') }}
                                        </x-jet-label>
                                        <x-livewire-select id="country_id" name="country_id"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.country_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Second nationality, if not present leave blank') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.second_country_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.second_country_id" />
                                    </div>
                                </div>
                                <div class="space-y-4">

                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Residence before beginning studies') }}</h5>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('State of residence before beginning studies') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.previous_residence_country_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_residence_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('State of residence prior to commencement of studies, if abroad please do not select and enter a state') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.previous_residence_state_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($previousResidenceStates as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_residence_state_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('District of residence before the start of the study') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.previous_residence_district_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($previousResidenceDistrict as $district)
                                                <option value="{{ $district->id }}">
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_residence_district_id" />
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Residence during studies') }}</h5>
                                    <div>
                                        <p class="italic mb-8 justify-end">
                                            {{ __('In case of different residences during the theory / practice phase, please choose the residence of the theory phase') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('State during studies, if the place of residence during the studies (not semester abroad) is in another state') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.current_residence_country_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.current_residence_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('State of residence during studies') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.current_residence_state_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($currentResidenceStates as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.current_residence_state_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('District during studies (Elmshorn is located in the district of Pinneberg)') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.current_residence_district_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($currentResidenceDistrict as $district)
                                                <option value="{{ $district->id }}">
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.current_residence_district_id" />
                                    </div>
                                </div>
                                <div class="space-y-4">

                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Initial enrollment') }}</h5>
                                    <div>
                                        <p class="italic">
                                            {{ __('If you have studied before, please select the first university you studied at and enter the corresponding time. If you have not studied before, please select NORDAKADEMIE as your first university with your entry date and 0 semesters studied so far.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('University in Germany where studies were started for the first time') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.enrollment_university_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->universities as $university)
                                                <option value="{{ $university->id }}">
                                                    {{ $university->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.enrollment_university_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('If the first enrollment was at an institution of higher education abroad, please indicate the state') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.enrollment_country_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.enrollment_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('University in Germany where studies were started for the first time (only specify if "other university" was selected)') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="text" placeholder="{{ __('Enter enrollment course') }}"
                                                     :disabled="!$isEdit"
                                                     wire:model.lazy="governmentForm.enrollment_course"
                                                     id="governmentForm_enrollment_course"></x-jet-input>
                                        <x-jet-input-error for="governmentForm.enrollment_course" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Semester in which studies were started for the first time') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           :isEdit="$isEdit"
                                                           model="governmentForm.enrollment_semester_id"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="" selected>{{ __('Semester Day') }}</option>
                                            <option value="1">{{ __('Summer semester') }}</option>
                                            <option value="2">{{ __('Winter semester') }}</option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.enrollment_semester_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Year in which studies were started for the first time') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="1900" max="2200"
                                                     :disabled="!$isEdit"
                                                     wire:model.lazy="governmentForm.enrollment_year"
                                                     placeholder="{{ _('z.B. 2016') }}"
                                                     id="governmentForm_enrollment_year">
                                        </x-jet-input>
                                        <x-jet-input-error for="governmentForm.enrollment_year" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Total of all semesters completed in Germany to date') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="0"
                                                     :disabled="!$isEdit"
                                                     wire:model.lazy="governmentForm.enrollment_total_semester"
                                                     placeholder="{{ __('Enter enrollment total semester') }}"
                                                     id="governmentForm_enrollment_total_semester"></x-jet-input>
                                        <x-jet-input-error for="governmentForm.enrollment_total_semester" />
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('School graduation') }}</h5>
                                    <div>
                                        <p class="italic">
                                            {{ __('It is to indicate the first school-leaving qualification that allows studying at a technical college/university regardless of the intended course of study.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Year of university entrance qualification / school-leaving qualification') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="1900" max="2200"
                                                     :disabled="!$isEdit"
                                                     wire:model.lazy="governmentForm.graduation_year"
                                                     placeholder="{{ __('Enter graduation year') }}"
                                                     id="governmentForm_graduation_year">
                                        </x-jet-input>
                                        <x-jet-input-error for="governmentForm.graduation_year" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Month of university entrance qualification, two digits (e.g. 07)') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="1" max="12"
                                                     wire:model.lazy="governmentForm.graduation_month"
                                                     :disabled="!$isEdit"
                                                     placeholder="{{ __('Enter graduation month') }}"
                                                     id="governmentForm_graduation_month"></x-jet-input>
                                        <x-jet-input-error for="governmentForm.graduation_month" />
                                    </div>
                                    <p>
                                        <b>{{ __('Explanation of terms:') }}</b>
                                        <span class="italic">
                                                {{ __('(aHR) general higher education entrance qualification, (FHS) advanced technical college entrance qualification, (fgHR) subject-related higher education entrance qualification.') }}
                                            </span>
                                    </p>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Type of university entrance qualification, in case of no equivalent, make an adequate choice') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.graduation_entrance_qualification_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}
                                            </option>
                                            @foreach ($this->entranceQualifications as $entranceQualification)
                                                <option value="{{ $entranceQualification->id }}">
                                                    {{ $entranceQualification->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.graduation_entrance_qualification_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('State of the university entrance qualification') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.graduation_country_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.graduation_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('State in which the university entrance qualification was obtained. Please select only one state for school-leaving qualifications obtained abroad') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.graduation_state_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($graduationStates as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.graduation_state_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('District of university entrance qualification') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.graduation_district_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($graduationDistrict as $district)
                                                <option value="{{ $district->id }}">
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.graduation_district_id" />
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Practical work experience before') }}</h5>
                                    <div>
                                        <p class="italic">
                                            {{ __('Only activities prior to the first degree count, not the current internship company and not Bundeswehr or civilian service.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Completed vocational training') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.is_vocational_training_completed"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.is_vocational_training_completed" />
                                    </div>
                                </div>
                                <div class="space-y-4">

                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Previous study') }}</h5>
                                    <div>
                                        <p class="italic">
                                            {{ __('Enter here the university at which you were enrolled in the semester immediately preceding the start of your studies at NORDAKADEMIE. If you were not enrolled at a university in the previous semester, please leave the fields empty.') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Enrolled in the last semester at another university') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.is_previous_another_university"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.is_previous_another_university" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Previous university') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_college_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->universities as $university)
                                                <option value="{{ $university->id }}">
                                                    {{ $university->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_college_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('If the previous university was abroad, please indicate the state') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_college_country_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_college_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Type of study') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_study_type_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyTypes as $studyType)
                                                <option value="{{ $studyType->id }}">
                                                    {{ $studyType->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_study_type_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Aimed final examination') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_final_exam_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->finalExams as $finalExam)
                                                <option value="{{ $finalExam->id }}">
                                                    {{ $finalExam->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_final_exam_id" />
                                    </div>


                                    <div>
                                        <p class="italic">
                                            {{ __('Subjects/programs of study (If double major or triple major, also indicate other programs of study):') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="italic p-4 bg-primary-light bg-opacity-25">
                                            <a href="{{ route('study-programs') }}" target="_blank"
                                               class="cursor-pointer text-sm text-primary hover:underline">{{ __('Correspondences for study programs at NORDAKADMIE') }}</a>
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Degree program (designation specified in the examination regulations in which a degree is possible)') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram1)
                                                <option value="{{ $studyProgram1->id }}">
                                                    {{ $studyProgram1->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_course_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Second degree program, specify only if more than one degree program was taken') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_second_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram2)
                                                <option value="{{ $studyProgram2->id }}">
                                                    {{ $studyProgram2->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_second_course_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Third degree program, specify only if more than one degree program was taken') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.previous_third_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram3)
                                                <option value="{{ $studyProgram3->id }}">
                                                    {{ $studyProgram3->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.previous_third_course_id" />
                                    </div>
                                </div>
                                <div class="space-y-4">

                                    <h5 class="text-primary font-semibold text-base md:text-lg leading-tight">
                                        {{ __('Already completed studies') }}</h5>
                                    <div>
                                        <p class="italic">
                                            {{ __('Provide information about your most recent final exam here') }}
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('University at which the final examination took place') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_university_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->universities as $university)
                                                <option value="{{ $university->id }}">
                                                    {{ $university->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_university_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('If the final examination was at a university abroad, please indicate the state') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_country_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}">
                                                    {{ $nationality->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_country_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Last final exam') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->finalExams as $finalExam)
                                                <option value="{{ $finalExam->id }}">
                                                    {{ $finalExam->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Type of study') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_study_type_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option> {{ __('Please select') }}</option>
                                            @foreach ($this->studyTypes as $studyType)
                                                <option value="{{ $studyType->id }}">
                                                    {{ $studyType->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_study_type_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Year') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="1900" max="2200"
                                                     wire:model.lazy="governmentForm.last_exam_year"
                                                     :disabled="!$isEdit"
                                                     placeholder="{{ __('Enter last exam year') }}"
                                                     id="governmentForm_last_exam_year">
                                        </x-jet-input>
                                        <x-jet-input-error for="governmentForm.last_exam_year" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Month') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="number" min="1" max="12"
                                                     wire:model.lazy="governmentForm.last_exam_month"
                                                     :disabled="!$isEdit"
                                                     placeholder="{{ __('Enter last exam month') }}"
                                                     id="governmentForm_last_exam_month"></x-jet-input>
                                        <x-jet-input-error for="governmentForm.last_exam_month" />
                                    </div>
                                    <div>
                                        <p class="italic">
                                            {{ __('Subjects/programs of study (If completing more than one program of study, also list the other programs of study and the grade of the most recent exam):') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="italic p-4 bg-primary-light bg-opacity-25">
                                            <a href="{{ route('study-programs') }}" target="_blank"
                                               class="cursor-pointer text-sm text-primary hover:underline">{{ __('Correspondences for study programs at NORDAKADMIE') }}</a>
                                        </p>
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Degree program (designation specified in the examination regulations in which a degree is possible)') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram11)
                                                <option value="{{ $studyProgram11->id }}">
                                                    {{ $studyProgram11->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_course_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Second degree program, specify only if more than one degree program was taken') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_second_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram22)
                                                <option value="{{ $studyProgram22->id }}">
                                                    {{ $studyProgram22->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_second_course_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Third degree program, specify only if more than one degree program was taken') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.last_exam_third_course_id"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value=""> {{ __('Please select') }}</option>
                                            @foreach ($this->studyPrograms as $studyProgram33)
                                                <option value="{{ $studyProgram33->id }}">
                                                    {{ $studyProgram33->name }}
                                                </option>
                                            @endforeach
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.last_exam_third_course_id" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block required">
                                            {{ __('Exam passed') }}
                                        </x-jet-label>
                                        <x-livewire-select id="is_active" name="is_active"
                                                           model="governmentForm.is_last_exam_pass"
                                                           :isEdit="$isEdit"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">{{ __('Please select') }}</option>
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </x-livewire-select>
                                        <x-jet-input-error for="governmentForm.is_last_exam_pass" />
                                    </div>
                                    <div>
                                        <x-jet-label for="is_active" class="block">
                                            {{ __('Examination result Grade (with 1 decimal place) e.g.: 2.8') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="text" placeholder="{{ __('Enter last exam grade') }}"
                                                     wire:model.lazy="governmentForm.last_exam_grade"
                                                     :disabled="!$isEdit"
                                                     id="governmentForm_last_exam_grade"></x-jet-input>
                                        <x-jet-input-error for="governmentForm.last_exam_grade" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                @if($errors->any())
                                    <span class="text-red">{{ __('Please complete all required fields.') }}</span>
                                @endif
                            </div>

                            <div class="py-3 text-right">
                                <x-primary-button type="submit" class="">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div>
                            <p class="mt-2 text-darkblack">
                                {{ $formAlreadySubmitted ? __('Your form already submitted successfully.') : __('Your form submitted successfully.') }}
                            </p>
                            <button class="mt-2 bg-darkgreen text-white px-4 py-2 underline" wire:click="$set('showThanks', false)" wire:loading.class="cursor-wait" >{{ __('Edit') }}</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
