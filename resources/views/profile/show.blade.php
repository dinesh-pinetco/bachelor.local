<x-app-layout>

    <!-- profile completed / uncompleted Notification -->
    <div
        class="hidden md:block fixed bottom-4 ml-4 md:ml-6 lg:ml-0 lg:left-1/3 xl:left-1/2 -translate-y-1/2 -translate-x-1/2 z-50">
        <div class="rounded-t-xl flex flex-wrap items-center px-6 py-4 h-full bg-primary">
            <label class="text-white font-bold mr-6 leading-7">{{ __('Submit application') }}</label>
            <div class="flex items-center space-x-4">
                <svg class="text-white w-5 h-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.63406 1.95134C8.43473 1.33734 7.56606 1.33734 7.36606 1.95134L6.3534 5.06734C6.30978 5.20111 6.22496 5.31765 6.11108 5.40028C5.9972 5.4829 5.8601 5.52738 5.7194 5.52735H2.4434C1.79806 5.52735 1.52873 6.35401 2.0514 6.73401L4.70206 8.65935C4.81593 8.74212 4.90066 8.85881 4.94414 8.9927C4.98761 9.12659 4.98758 9.2708 4.94406 9.40468L3.93206 12.5207C3.73206 13.1347 4.4354 13.646 4.9574 13.266L7.60806 11.3407C7.72199 11.2579 7.85922 11.2133 8.00006 11.2133C8.14091 11.2133 8.27814 11.2579 8.39206 11.3407L11.0427 13.266C11.5647 13.646 12.2681 13.1353 12.0681 12.5207L11.0561 9.40468C11.0125 9.2708 11.0125 9.12659 11.056 8.9927C11.0995 8.85881 11.1842 8.74212 11.2981 8.65935L13.9487 6.73401C14.4707 6.35401 14.2027 5.52735 13.5567 5.52735H10.2801C10.1395 5.52724 10.0025 5.4827 9.88878 5.40008C9.77503 5.31746 9.69031 5.201 9.64673 5.06734L8.63406 1.95134Z"
                        stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                @inject('progressbar', 'App\Services\ProgressBar')
                <div class="w-20 relative">
                    <div class="overflow-hidden h-2 text-xs flex rounded bg-lightgray">
                        <div style="width:{{ $progressbar->overAllProgress() }}%"
                             class="shadow-none flex flex-col text-center rounded-full whitespace-nowrap text-white justify-center
                                @if($progressbar->overAllProgress() === 0) bg-gray
                                @elseif($progressbar->overAllProgress() <= 80) bg-primary-light
                                @elseif($progressbar->overAllProgress() === 100) bg-primary
                                @endif transition duration-150 ease-in-out">
                        </div>
                    </div>
                </div>
                <span class="text-xs text-white font-bold"> {{ $progressbar->overAllProgress() }}%</span>
            </div>
        </div>
    </div>
    <div class="px-4 md:px-6 max-w-screen-xl w-full mx-auto">
        <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Profile') }}
        </h2>
        <form method="POST" action='{{ route("user-profile-information.update") }}' enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="-mx-4 flex flex-wrap justify-between items-start">
                <div class="px-4 w-full lg:w-1/2 xl:w-2/5">
                    <h4 class="mb-3 text-xl font-medium text-primary">
                        {{ __('Personal Information') }}
                    </h4>
                    <div class="mb-3">
                        @if(auth()->user()->profile_photo_path)
                            <div class="profile-img w-36 h-36 relative">
                                <div class="w-full h-full rounded-full overflow-hidden">
                                    <img class="w-full h-full object-cover object-center"
                                         src="{{ auth()->user()->profile_photo_url }}"
                                         alt="{{ auth()->user()->first_name }}">
                                </div>
                                <a href="{{ route('profile.destroy') }}"
                                   class="img-overlay duration-150 ease-in rounded-full absolute top-0 left-0 w-full h-full bg-primary bg-opacity-80 flex justify-center items-center">
                                    <span>
                                        <svg class="stroke-current w-6 h-6 text-white" fill="none">
                                            <path
                                                d="M10 11v6m4-6v6M4 7h16m-1 0l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7h14zm-4 0V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3h6z"
                                                stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        @else
                            <div class="h-36 flex flex-col justify-center">
                                <x-jet-label>{{ __('Application Photo') }}</x-jet-label>
                                <label
                                    class="w-44 flex flex-col items-center p-2 bg-primary text-white rounded-sm cursor-pointer hover:bg-opacity-90">
                                    <span class="text-base leading-normal">{{ __('Select a file') }}</span>

                                    <input type="file" name="photo" id="photo" class="hidden">
                                </label>
                                <h6 class="text-xs mt-2 font-light">JPG, max 200kb</h6>
                            </div>
                            @if ($errors->updateProfileInformation->first('photo'))
                                <span style="color: red;">
                                    {{ $errors->updateProfileInformation->first('photo') }}
                                </span>
                            @endif
                        @endif

                    </div>

                    <div class="mb-7">
                        <x-jet-label value="{{ __('Gender') }}"></x-jet-label>
                        <x-livewire-select name="gender">
                            <option disabled selected> {{ __('Select Gender') }}</option>
                            <option @if (auth()->user()->gender == User::GENDER_MALE) selected
                                    @endif value="{{ User::GENDER_MALE }}">{{ __('Male') }}
                            </option>
                            <option @if (auth()->user()->gender == User::GENDER_FEMALE) selected @endif
                                value="{{ User::GENDER_FEMALE }}">
                                {{ __('Female') }}
                            </option>
                            <option @if (auth()->user()->gender == User::GENDER_OTHER) selected
                                    @endif  value="postgraduate">{{ __('Other') }}
                            </option>
                        </x-livewire-select>
                        @if ($errors->updateProfileInformation->first('gender'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('gender') }}</span>
                        @endif
                    </div>

                    <div class="mb-7">
                        <x-jet-label value="{{ __('First name') }}"></x-jet-label>
                        <x-jet-input class="w-full" type="text" name="first_name"
                                     value="{{ auth()->user()->first_name }}"
                                     placeholder="{{ __('Enter First name') }}"></x-jet-input>
                        <x-jet-input-error for="first_name" class="mt-2 text-red"></x-jet-input-error>
                        @if ($errors->updateProfileInformation->first('first_name'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('first_name') }}</span>
                        @endif
                    </div>

                    <div class="mb-7">
                        <x-jet-label value="{{ __('Last name') }}"></x-jet-label>
                        <x-jet-input class="w-full" type="text" name="last_name" value="{{ auth()->user()->last_name }}"
                                     placeholder="{{ __('Enter last name') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('last_name'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Academic Degree / Title') }}"></x-jet-label>
                        <x-livewire-select name="academic_title">
                            <option disabled selected> {{ __('Select Academic Degree / Title') }}</option>
                            <option @if (auth()->user()->academic_title == "undergraduate") selected
                                    @endif value="undergraduate">{{ __('Undergraduate') }}
                            </option>
                            <option @if (auth()->user()->academic_title == "graduate") selected @endif value="graduate">
                                Graduate
                            </option>
                            <option @if (auth()->user()->academic_title == "postgraduate") selected
                                    @endif  value="postgraduate">{{ __('Postgraduate') }}
                            </option>
                        </x-livewire-select>
                        @if ($errors->updateProfileInformation->first('academic_title'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('academic_title') }}</span>
                        @endif
                    </div>
                    @php
                        $date = Str::of(auth()->user()->dob)->explode('-');
                    @endphp
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Birth Date') }}"></x-jet-label>

                        <div class="flex space-x-4">
                            <div class="w-full">
                                <x-livewire-select name="day" class="flex-grow">
                                    <option disabled selected>{{ __('Day') }}</option>
                                    @for ($i = 1; $i >= 31; $i++)
                                        <option @if(data_get($date,'2') == sprintf('%02d', $i)) selected @endif  value="sprintf('%02d', $i)">$i</option>
                                    @endfor
                                </x-livewire-select>
                            </div>
                            <div class="w-full">
                                <x-livewire-select class="flex-grow" name="month">
                                    <option disabled selected>{{ __('Month') }}</option>
                                    <option @if(data_get($date, '1') == '01') selected @endif  value="01">{{ __('January') }} </option>
                                    <option @if(data_get($date, '1') == '02') selected @endif  value="02">{{ __('February') }}</option>
                                    <option @if(data_get($date, '1') == '03') selected @endif  value="03">{{ __('March') }}</option>
                                    <option @if(data_get($date, '1') == '04') selected @endif  value="04">{{ __('April') }}</option>
                                    <option @if(data_get($date, '1') == '05') selected @endif  value="05">{{ __('May') }}</option>
                                    <option @if(data_get($date, '1') == '06') selected @endif  value="06">{{ __('June') }}</option>
                                    <option @if(data_get($date, '1') == '07') selected @endif  value="07">{{ __('July') }}</option>
                                    <option @if(data_get($date, '1') == '08') selected @endif  value="08">{{ __('August') }}</option>
                                    <option @if(data_get($date, '1') == '09') selected @endif  value="09">{{ __('September') }}</option>
                                    <option @if(data_get($date, '1') == '10') selected @endif  value="10">{{ __('October') }}</option>
                                    <option @if(data_get($date, '1') == '11') selected @endif  value="11">{{ __('November') }}</option>
                                    <option @if(data_get($date, '1') == '12') selected @endif  value="12">{{ __('December') }}</option>
                                </x-livewire-select>
                            </div>
                            <div class="w-full">
                                <x-livewire-select class="flex-grow" name="year">
                                    <option disabled selected>{{ __('Year') }}</option>
                                    @for ($i=PAST_YEAR; $i<=now()->year;$i++)
                                        <option @if ($i == data_get($date, '0')) selected
                                                @endif value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </x-livewire-select>
                            </div>
                        </div>
                        @if ($errors->updateProfileInformation->first('dob'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('dob') }}</span>
                        @endif
                    </div>

                    <div class="mb-7">
                        <x-jet-label value="{{ __('Place of Birth') }}"></x-jet-label>
                        <x-jet-input class="w-full" value="{{ auth()->user()->place_of_birth }}" name="place_of_birth"
                                     type="text" placeholder="{{ __('Enter Place of Birth') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('place_of_birth'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('place_of_birth') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Country of Birth') }}"></x-jet-label>
                        <x-jet-input class="w-full" name="place_of_country" type="text"
                                     value="{{ auth()->user()->place_of_country }}"
                                     placeholder="{{ __('Enter Place of Birth') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('place_of_birth'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('place_of_country') }}</span>
                        @endif
                    </div>

                    <div class="mb-7">
                        <x-jet-label value="{{ __('Citizenship (State)') }}"></x-jet-label>
                        <x-jet-input class="w-full" name="citizenship_of_state" type="text"
                                     value="{{ auth()->user()->citizenship_of_state }}"
                                     placeholder="{{ __('Enter Citizenship (State)') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('place_of_birth'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('citizenship_of_state') }}</span>
                        @endif
                    </div>
                </div>
                <div class="px-4 w-full lg:w-1/2 xl:w-2/5">
                    <h4 class="mb-3 text-xl font-medium text-primary">
                        {{ __('Application for the') }}
                    </h4>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Desired Course of Study') }}"></x-jet-label>

                        @php
                            $courses = ContactProfile::latest()->get();
                        @endphp
                        <x-livewire-select name="course_id">
                            <option disabled selected> {{ __('Select Desired Course of Study') }}</option>
                            @foreach ($courses->unique() as $course)
                                <option value="{{ $course->id }}"
                                        @if ($course->id == auth()->user()->course_id) selected @endif>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </x-livewire-select>
                        @if ($errors->updateProfileInformation->first('course_id'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('course_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('At the desired start of studies *') }}"></x-jet-label>
                        @php
                            $desiredBeginnings = DesiredBeginning::all();
                        @endphp
                        <x-livewire-select name="desired_beginning_id">
                            <option selected disabled> {{ __('Select Desired start of studies') }}</option>
                            @foreach ($desiredBeginnings as $desiredBeginning)
                                <option value="{{ $desiredBeginning->id }}"
                                        @if ($desiredBeginning->id == auth()->user()->desired_beginning_id) selected
                                    @endif>
                                    {{ $desiredBeginning->name }}
                                </option>
                            @endforeach
                        </x-livewire-select>
                        @if ($errors->updateProfileInformation->first('desired_beginning_id'))
                            <span
                                style="color: red;">{{ $errors->updateProfileInformation->first('desired_beginning_id') }}</span>
                        @endif
                    </div>
                    <h4 class="mb-3 text-xl font-medium text-primary">
                        {{ __('Contact Details') }}
                    </h4>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Street / House Number') }}"></x-jet-label>
                        <x-jet-input type="text" name="address" value="{{ auth()->user()->address }}" class="w-full"
                                     placeholder="{{ __('Enter Street & House Number') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('address'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('address') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Postcode') }}"></x-jet-label>
                        <x-jet-input type="text" value="{{ auth()->user()->pin_code }}" name="pin_code" class="w-full"
                                     placeholder="{{ __('Enter Post code') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('pin_code'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('pin_code') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Location') }}"></x-jet-label>
                        <x-jet-input type="text" name="location" value="{{ auth()->user()->location }}" class="w-full"
                                     placeholder="{{ __('Enter Location') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('location'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('location') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Telephone') }}"></x-jet-label>
                        <x-jet-input type="tel" value="{{ auth()->user()->phone }}" name="phone" class="w-full"
                                     placeholder="{{ __('Enter Telephone') }}" maxlength="15"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('phone'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="mb-7">
                        <x-jet-label value="{{ __('Email Address') }}"></x-jet-label>
                        <x-jet-input type="text" name="email" value="{{ auth()->user()->email }}" class="w-full"
                                     placeholder="{{ __('Enter Email Address') }}"></x-jet-input>
                        @if ($errors->updateProfileInformation->first('email'))
                            <span style="color: red;">{{ $errors->updateProfileInformation->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-7 flex items-center space-x-4">
                        <input type="checkbox" name="privacy_policy"
                               class="rounded-sm w-4 h-4 text-primary focus:ring focus:ring-primary-light focus:ring-opacity-50"
                               id="privacy" @if(auth()->user()->terms_condition ) checked @endif />
                        <label for="privacy"
                               class="text-xs text-primary font-light cursor-pointer">{{ __('I have read the') }} <a
                                class="hover:underline font-bold">{{ __('Privacy Policy') }}</a> {{ __('and I agree to it.') }}
                        </label>
                    </div>
                    @if ($errors->updateProfileInformation->first('privacy_policy'))
                        <span
                            style="color: red;">{{ $errors->updateProfileInformation->first('privacy_policy') }}</span>
                    @endif
                    <div class="text-right">
                        <x-primary-button>
                            {{ __('save') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>

