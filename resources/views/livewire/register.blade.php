<div>
    <form method="POST" action="{{ route('register') }}" id="application_register" onsubmit="submitForm()">
        @csrf
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 xl:gap-y-8 xl:gap-x-10 place-content-end">
            <div>
                <x-jet-label class="text-white font-bold required"
                             for="desired_beginning"
                             value="{{ __('Desired start') }}"></x-jet-label>
                <x-livewire-select id="desired_beginning"
                                   name="desired_beginning"
                                   model="desired_beginning">
                    <option value="">{{ __('Please select') }}</option>
                    @foreach($desiredBeginnings as $desiredBeginning)
                        <option
                            value="{{ data_get($desiredBeginning,'key') }}">
                            {{ data_get($desiredBeginning,'title') }}
                        </option>
                    @endforeach
                </x-livewire-select>
            </div>
            <div wire:ignore>
                <x-jet-label class="text-white font-bold required" for="name"
                             value="{{ __('First name') }}"></x-jet-label>
                <x-jet-input id="first_name" class="block w-full" type="text" name="first_name"
                             :value="old('first_name')"
                             placeholder="{{ __('Enter First name') }}"
                             required
                             autofocus autocomplete="name"></x-jet-input>
            </div>
            <div wire:ignore>
                <x-jet-label class="text-white font-bold required" for="password"
                             value="{{ __('Last name') }}"></x-jet-label>
                <x-jet-input id="last_name" class="block w-full" type="text" name="last_name"
                             :value="old('last_name')"
                             placeholder="{{ __('Enter last name') }}"></x-jet-input>
            </div>
            <div class="self-end">
                <x-jet-label class="text-white font-bold required" for="courseId"
                             value="{{ __('Select course') }}"></x-jet-label>
                <x-multi-select
                    name="course_ids"
                    wire:model="course_ids"
                    :placeholder="__('Select course')"
                    :options="$courses"
                    :value="old('course_ids',$course_ids)"
                    keyBy="id"
                    labelBy="name"
                    maxHight="h-32"
                />
            </div>
            <div wire:ignore>
                <x-jet-label class="text-white font-bold required" for="email" value="{{ __('E-mail address') }}">
                </x-jet-label>
                <x-jet-input id="email" class="block w-full" type="email" name="email" :value="old('email')"
                             placeholder="{{ __('Enter email address') }}" required></x-jet-input>
            </div>
            <div class="tel-input" wire:ignore>
                <x-jet-label class="text-white font-bold" for="password_confirmation"
                             value="{{ __('Phone number') }}"></x-jet-label>
                <x-input-tel class="block w-full bg-white text-black" />
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
        </div>
        <div class="flex items-center justify-end mt-6 md:mt-10">
            <x-jet-secondary-button type="button" onclick="submitForm()">
                {{ __('Start application') }}
                <svg class="stroke-current ml-4" width="20" height="16" viewBox="0 0 20 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1L19 8M19 8L12 15M19 8H1" stroke="stroke-current" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-jet-secondary-button>
        </div>
        <div class="flex items-center justify-end mt-2 md:mt-4 pb-1">
            <p>{{ __('Already signed up') }}?
                <a href="{{ route('login') }}"
                   class="inline-block underline hover:text-primary">{{ __('Log in') }}
                </a>
            </p>
        </div>
    </form>


    @push('scripts')
        <script>
            function submitForm() {
                document.querySelector("#application_register").submit();
            }
        </script>
    @endpush
</div>
