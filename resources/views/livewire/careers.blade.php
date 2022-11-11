<div class="container flex flex-wrap xl:px-20">
    <div class="flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
        <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0">
            <svg class="w-16 h-16 lg:w-24 xl:w-32 lg:h-24 xl:h-32 text-primary" viewBox="0 0 120 120" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M75.8601 34.9999L42.9301 67.9299C41.975 68.8524 41.2132 69.9559 40.6891 71.1759C40.165 72.3959 39.8891 73.7081 39.8776 75.0359C39.8661 76.3637 40.1191 77.6805 40.6219 78.9095C41.1247 80.1384 41.8672 81.255 42.8061 82.1939C43.7451 83.1328 44.8616 83.8753 46.0906 84.3781C47.3195 84.881 48.6363 85.134 49.9641 85.1224C51.2919 85.1109 52.6041 84.835 53.8241 84.311C55.0442 83.7869 56.1476 83.025 57.0701 82.0699L89.1401 49.1399C92.7833 45.3679 94.7992 40.3158 94.7536 35.0719C94.708 29.828 92.6046 24.8117 88.8965 21.1036C85.1883 17.3954 80.1721 15.292 74.9281 15.2465C69.6842 15.2009 64.6321 17.2168 60.8601 20.8599L28.7851 53.7849C23.1585 59.4115 19.9976 67.0428 19.9976 74.9999C19.9976 82.9571 23.1585 90.5884 28.7851 96.2149C34.4117 101.842 42.0429 105.002 50.0001 105.002C57.9573 105.002 65.5885 101.842 71.2151 96.2149L102.5 64.9999"
                        stroke="currentcolor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>

    <div class="flex-grow w-1/3 flex flex-wrap text-primary">
        <div class="w-full">
            <h3 class="text-2xl md:text-3xl py-10">{{ __('Brief overview of your professional activities') }}</h3>
        </div>

        <div class="w-full flex flex-wrap -mx-4 mb-16 xl:mb-10 space-y-6 xl:space-y-0">
            <div class="w-full xl:w-7/12 px-4">
                <div class="max-w-md">
                    @foreach($activity_periods as $key => $activity_period)
                        <div wire:key="$key" id="activity_{{ $key }}">
                            <div class="flex">
                                <h4 class="text-xl mb-4 font-medium">{{ __('Employer since first academic degree*') }}</h4>
                                @if(data_get($activity_period, 'id') || count($activity_periods) > 1)
                                    <span>
                                    <a href="javascript:void(0);" class="py-2 flex-shrink-0 inline-block"
                                       @click="$wire.removeActivityPeriod({{ $key }}); document.getElementById('activity_{{ $key }}').remove();"
                                    >
                                        <svg class="w-5 h-5 text-primary" viewBox="0 0 18 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 9V15M11 9V15M1 5H17M16 5L15.133 17.142C15.0971 17.6466 14.8713 18.1188 14.5011 18.4636C14.1309 18.8083 13.6439 19 13.138 19H4.862C4.35614 19 3.86907 18.8083 3.49889 18.4636C3.1287 18.1188 2.90292 17.6466 2.867 17.142L2 5H16ZM12 5V2C12 1.73478 11.8946 1.48043 11.7071 1.29289C11.5196 1.10536 11.2652 1 11 1H7C6.73478 1 6.48043 1.10536 6.29289 1.29289C6.10536 1.48043 6 1.73478 6 2V5H12Z"
                                                  stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </span>
                                @endif
                            </div>
                            <div class="mb-6 md:mb-10">
                                <x-jet-label value="{{ __('Company name') }}"/>
                                <x-jet-input class="w-full" type="text"
                                             wire:model.defer="activity_periods.{{ $key }}.company_name"
                                             placeholder="{{ __('Enter company name') }}"/>
                                <x-jet-input-error class="mt-2"
                                                   for="activity_periods.{{ $key }}.company_name"></x-jet-input-error>
                            </div>
                            <h4 class="text-xl mb-4 font-medium">{{ __('Period of activity') }}</h4>
                            <div class="mb-6 md:mb-10">
                                <x-jet-label value="{{ __('Beginning') }}"/>
                                <x-jet-input class="w-full" type="month"
                                             wire:model.debounce.500ms="activity_periods.{{ $key }}.begin" value="2021-08"
                                             placeholder="{{ __('Enter the time') }}"/>
                                <x-jet-input-error class="mt-2"
                                                   for="activity_periods.{{ $key }}.begin"></x-jet-input-error>
                            </div>
                            <div class="mb-6 md:mb-10">
                                <x-jet-label value="{{ __('End') }}"/>
                                <x-jet-input class="w-full" type="month"
                                             wire:model.debounce.500ms="activity_periods.{{ $key }}.end" value="2021-08"
                                             min="{{$activity_period['begin']}}"
                                             placeholder="{{ __('Enter the time') }}"/>
                                <x-jet-input-error class="mt-2"
                                                   for="activity_periods.{{ $key }}.end"></x-jet-input-error>
                            </div>
                        </div>
                    @endforeach
                    <label>
                        <div class="flex my-4 cursor-pointer" wire:click="addActivityPeriod">
                            <svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 7V10M10 10V13M10 10H13M10 10H7M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                        stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                            </svg>
                            <h5 class="text-base font-bold ml-4 leading-5">{{ __('add another employer') }}</h5>
                        </div>
                    </label>
                </div>
            </div>

            <div class="w-full xl:w-5/12 px-4 space-y-4">
                <p>{{ __('Please provide a brief overview of your professional career.Please start with your current position. If necessary, please insert additional lines.') }}</p>

                <p>{{ __('If no time is entered for End, it is assumed that you are currently holding the position. exercise.') }}</p>

                <p><b>{{ __('If you have not performed any work to date, please write none as the employer and leave the period open.') }}</b></p>
            </div>
        </div>

        <div class="w-full flex flex-wrap -mx-4 mb-16 xl:mb-10 space-y-6 xl:space-y-0">
            <div class="w-full xl:w-7/12 px-4">
                <div class="max-w-md">
                    @foreach($employer_academic_degrees as $key => $employer_academic_degree)
                        <div class="flex" id="employer_degree_{{$key}}">
                            <h4 class="text-xl mb-4 font-medium">{{ __('Employer since first academic degree*') }}</h4>
                            @if(data_get($employer_academic_degree, 'id') || count($employer_academic_degrees) > 1)
                            <span>
                                <a href="javascript:void(0);" class="py-2 flex-shrink-0 inline-block"
                                   @click="$wire.removeEmployerAcademicDegree({{ $key }}); document.getElementById('employer_degree_{{ $key }}').remove();">
                                    <svg class="w-5 h-5 text-primary" viewBox="0 0 18 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 9V15M11 9V15M1 5H17M16 5L15.133 17.142C15.0971 17.6466 14.8713 18.1188 14.5011 18.4636C14.1309 18.8083 13.6439 19 13.138 19H4.862C4.35614 19 3.86907 18.8083 3.49889 18.4636C3.1287 18.1188 2.90292 17.6466 2.867 17.142L2 5H16ZM12 5V2C12 1.73478 11.8946 1.48043 11.7071 1.29289C11.5196 1.10536 11.2652 1 11 1H7C6.73478 1 6.48043 1.10536 6.29289 1.29289C6.10536 1.48043 6 1.73478 6 2V5H12Z"
                                              stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </span>
                            @endif
                        </div>
                        <div class="mb-6">
                            <x-jet-label value="{{ __('Name of the college') }}"/>
                            <x-jet-input class="w-full"
                                         wire:model.defer="employer_academic_degrees.{{$key}}.college_name" type="text"
                                         placeholder="{{ __('Enter name') }}"/>
                            <x-jet-input-error class="mt-2"
                                               for="employer_academic_degrees.{{$key}}.college_name"></x-jet-input-error>
                        </div>
                        <div class="mb-6">
                            <x-jet-label value="{{ __('Course of study') }}"/>
                            <x-jet-input class="w-full"
                                         wire:model.defer="employer_academic_degrees.{{$key}}.course_name" type="text"
                                         placeholder="{{ __('Enter course of study') }}"/>
                            <x-jet-input-error class="mt-2"
                                               for="employer_academic_degrees.{{$key}}.course_name"></x-jet-input-error>
                        </div>
                        <div class="mb-6">
                            <x-jet-label for="degree-{{$key}}" value="{{ __('Degree acquired') }}"/>
                            <select id="degree-{{$key}}" wire:model.defer="employer_academic_degrees.{{$key}}.degree"
                                    class="py-2.5 px-4 border border-gray focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm text-primary placeholder-gray w-full cursor-pointer">
                                <option value=""> {{ __('Please select') }}</option>
                                <option value="Bachelor of Architecture">{{ __('B.A.') }}</option>
                                <option value="Bachelor of Arts">{{ __('B.Sc.') }}</option>
                                <option value="Master of Economics">{{ __('B.Eng.') }}</option>
                                <option value="Master of Accountancy">{{ __('M.A.') }}</option>
                                <option value="Master of Accountancy">{{ __('M.Sc.') }}</option>
                                <option value="Master of Accountancy">{{ __('M.Eng.') }}</option>
                                <option value="Master of Accountancy">{{ __('Dr.') }}</option>
                                <option value="Master of Accountancy">{{ __('Other') }}</option>
                            </select>
                            <x-jet-input-error class="mt-2"
                                               for="employer_academic_degrees.{{$key}}.degree"></x-jet-input-error>
                        </div>
                        <div class="mb-6">
                            <x-jet-label value="{{ __('ECTS credit points') }}"/>
                            <x-jet-input class="w-full"
                                         wire:model.defer="employer_academic_degrees.{{$key}}.ects_credit_point"
                                         type="text" placeholder="{{ __('Enter points') }}"/>
                            <x-jet-input-error class="mt-2"
                                               for="employer_academic_degrees.{{$key}}.ects_credit_point"></x-jet-input-error>
                        </div>
                        <div class="mb-6">
                            <x-jet-label value="{{ __('Month / year of graduation') }}"/>
                            <x-jet-input class="w-full"
                                         wire:model.defer="employer_academic_degrees.{{$key}}.graduation_date"
                                         type="month" value="2021-08" placeholder="{{ __('Enter the time') }}"/>
                            <x-jet-input-error class="mt-2"
                                               for="employer_academic_degrees.{{$key}}.graduation_date"></x-jet-input-error>
                        </div>
                    @endforeach
                    <label>
                        <div class="flex my-6 mt-10 cursor-pointer" wire:click="addEmployeeAcademicDegree">
                            <svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 7V10M10 10V13M10 10H13M10 10H7M19 10C19 11.1819 18.7672 12.3522 18.3149 13.4442C17.8626 14.5361 17.1997 15.5282 16.364 16.364C15.5282 17.1997 14.5361 17.8626 13.4442 18.3149C12.3522 18.7672 11.1819 19 10 19C8.8181 19 7.64778 18.7672 6.55585 18.3149C5.46392 17.8626 4.47177 17.1997 3.63604 16.364C2.80031 15.5282 2.13738 14.5361 1.68508 13.4442C1.23279 12.3522 1 11.1819 1 10C1 7.61305 1.94821 5.32387 3.63604 3.63604C5.32387 1.94821 7.61305 1 10 1C12.3869 1 14.6761 1.94821 16.364 3.63604C18.0518 5.32387 19 7.61305 19 10Z"
                                        stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                            </svg>
                            <h5 class="text-base font-bold ml-4 leading-5">{{ __('add further higher education') }}</h5>
                        </div>
                    </label>
                </div>
            </div>

            <div class="w-full xl:w-5/12 px-4 space-y-4">
                <p>{{ __('Please provide a brief overview of your college education, beginning with the most recent institution attended.') }}</p>

                <p>{{ __('If your undergraduate degree is not yet completed, please indicate the degree you are seeking.') }}</p>
            </div>
        </div>

        <div class="w-full flex flex-wrap -mx-4 mb-16 xl:mb-10 space-y-6 xl:space-y-0">
            <div class="w-full xl:w-7/12 px-4">
                <div class="max-w-md">
                    <div class="mb-6">
                        <x-jet-label value="{{ __('Note') }}"/>
                        <x-jet-input class="w-full" type="text" wire:model.defer="career.grade"
                                     placeholder="{{ __('Enter note / number') }}"/>
                        <x-jet-input-error class="mt-2"
                                           for="career.grade"></x-jet-input-error>
                    </div>
                    <a href="javascript:void(0);" class="inline-block">
                        <x-primary-button class="mt-4" wire:click="upsertCareer">
                            {{ __('Save and continue') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>

            <div class="w-full xl:w-5/12 px-4 space-y-4">
                <p>{{ __('Please enter the final/average grade of the highest educational qualification.If your first degree has not yet been completed, please enter the current average grade.') }}</p>
            </div>
        </div>
    </div>
</div>
