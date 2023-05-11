<div class="max-w-screen-xl mx-auto">
    @role(ROLE_APPLICANT)
    @if(!$isProfile)
        <livewire:tabs :applicant="$applicant"/>
    @else
        <div class="w-full max-w-screen-xl mx-auto">
            <div class="flex">
                <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
                <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                    {{ __('Profile') }}
                </h1>
            </div>
        </div>
    @endif
    @else
        <livewire:tabs :applicant="$applicant"/>
        @endrole

        <div class="flex flex-wrap relative {{ $isProfile ? 'max-w-screen-xl mx-auto' : '' }}">
            @if (!$isProfile)
                <div class="flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64 absolute lg:static left-0">
                    <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0">
                        <x-svg-icon type="{{ $tab->icon }}" size="large"/>
                    </div>
                </div>
            @elseif($isProfile)
                <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64">
                    <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0"></div>
                </div>
            @endif

            <div class="flex-grow w-1/3 text-primary relative">
                @if($isProfile && auth()->user()->hasRole(ROLE_APPLICANT))
                    <p>{{ __("Let's go: Fill in all data fields and take the selection test. Then you are ready to study at NORDAKADEMIE.") }}</p>
                    <p class="mt-3">{{ __("Your data is automatically saved while you enter it and you can interrupt at any time and log back in later to continue the process.") }}</p>
                    <p class="mt-3">{{ __("PLEASE NOTE: However, you cannot interrupt the selection test.") }}</p>
                @endif
                <div class="md:flex items-center justify-between {{ $isProfile ? 'my-7 lg:my-10' : '' }}">
                    <div>
                        <h6 class="text-2xl md:text-3xl font-medium text-primary {{ $isProfile ? '' : 'ml-20 md:ml-32 lg:ml-0 my-7 lg:my-10' }}">
                            {{ __($tab->description) }}
                        </h6>
                        @if($isProfile && auth()->user()->hasRole(ROLE_APPLICANT))
                            <p class="text-sm text-primary mt-2">
                                {{ __("Please fill out mandatory fields marked with a *") }}
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4 flex-shrink-0">
                        @if (!auth()->user()->hasRole(ROLE_APPLICANT) && $isProfile && $isEnrolled)
                            <div class="inline-flex items-center gap-2 text-green-500 text-sm mt-4 md:mt-0">
                                <svg class="w-3 h-3 fill-current" fill="currentcolor" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 512 512">
                                    <path
                                        d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/>
                                </svg>
                                <p>{{__('Has been hired')}}</p>
                            </div>
                        @endif
                        @if(!auth()->user()->hasRole(ROLE_APPLICANT) && $applicant->application_status->id() > ApplicationStatus::TEST_TAKEN->id() && $isProfile)
                            <div class="flex items-center space-x-4">
                                <x-primary-button type="button"
                                                  wire:click="$emit('Applicant.Modal.Enrollment.modal.toggle',{{ $applicant->id }})"
                                                  :disabled="!$isEdit"
                                                  class="md:-mt-0 {{ $isEdit ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                                    {{ __('Enroll Applicant') }}
                                </x-primary-button>
                            </div>
                        @endif
                        <div class="flex items-center space-x-4">
                            <x-primary-button type="button"
                                              wire:click="$emit('Applicant.Modal.Anonymous.modal.toggle',{{ $applicant->id }})"
                                              :disabled="!$applicant->email"
                                              class="md:-mt-0 {{ $applicant->email ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                                {{ __('Anonymous') }}
                            </x-primary-button>
                        </div>
                    </div>
                    @if(auth()->user()->hasRole(ROLE_APPLICANT) && !$isProfile)
                        <div>
                            <div class="flex items-center justify-end space-x-2 mb-5 md:mb-0">
                                @if($tab?->slug != 'industries')
                                    <div>
                                        <a class="w-10 h-10 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-sm"
                                           href="industries">
                                            <svg class="w-4 h-4 stroke-current text-white flex-shrink-0" width="25"
                                                 height="25" viewBox="0 0 24 24" stroke-width="2.50" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg" color="#003A79">
                                                <path d="M21 12H3m0 0l8.5-8.5M3 12l8.5 8.5" stroke="currentcolor"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>

                                    <div>
                                        <a class="w-10 h-10 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-sm"
                                           href="{{ route('documents.index') }}">
                                            <svg class="w-4 h-4 stroke-current text-white flex-shrink-0" width="25"
                                                 height="25" viewBox="0 0 24 24" stroke-width="2.50" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg" color="currentcolor">
                                                <path d="M3 12h18m0 0l-8.5-8.5M21 12l-8.5 8.5" stroke="currentcolor"
                                                      stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <div>
                                        <a class="w-28 h-10 flex items-center justify-center text-white bg-primary rounded-sm" href="{{ route('companies.index') }}">
                                            {{ __("Skip") }}
                                        </a>
                                    </div>
                                    <a class="w-10 h-10 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-sm"
                                       href="motivation">
                                        <svg class="w-4 h-4 stroke-current text-white flex-shrink-0" width="25"
                                             height="25" viewBox="0 0 24 24" stroke-width="2.50" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" color="currentcolor">
                                            <path d="M3 12h18m0 0l-8.5-8.5M21 12l-8.5 8.5" stroke="currentcolor"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                @if (!empty($parentCustomGroups))
                    @foreach ($parentCustomGroups as $parentCustomGroupKey => $parentCustomGroup)
                        @foreach ($parentCustomGroup as $groupKey => $group)
                            @php
                                $customGroupKey = $applicant->id . $parentCustomGroupKey . $groupKey;
                            @endphp
                            <div class="lg:flex mb-10 lg:-mx-4" id="group-key-{{ $customGroupKey }}"
                                 wire:key="{{ $customGroupKey }}">
                                <div class="w-full lg:w-1/2 lg:px-4 lg:max-w-md mr-auto">
                                    @if ($group->title)
                                        <label class="mb-4 text-xl md:text-3xl font-bold text-primary"
                                               for="">{{ $group->title }}</label>
                                    @endif
                                    <div class="w-full space-y-8">
                                        @foreach ($group->fields as $fieldKey => $field)
                                            @if ($field->relationLoaded('values') && count($field->values) > 0)
                                                @forelse ($field->values as $value)
                                                    <div class="value" wire:key="{{ $fieldKey }}">
                                                        <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                        :groupKey="$customGroupKey" :value="$value"
                                                                        :key="time() . $value->id"/>
                                                        <x-jet-input-error for="field.{{ $field['key'] }}"
                                                                           class="mt-2"/>
                                                    </div>
                                                @empty
                                                    <div class="field" wire:key="{{ $fieldKey }}">
                                                        <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                        :groupKey="$customGroupKey" :field="$field"
                                                                        :key="time() . $field->id"/>
                                                    </div>
                                                @endforelse
                                            @else
                                                <div class="field" wire:key="{{ $fieldKey }}">
                                                    <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                    :groupKey="$customGroupKey" :field="$field"
                                                                    :key="time() . $field->id"/>
                                                    <x-jet-input-error for="field.{{ $field['key'] }}" class="mt-2"/>
                                                </div>
                                            @endif
                                        @endforeach

                                        @foreach ($group->child as $child)
                                            <div class="space-y-8" wire:key="{{ $child->id }}">
                                                @if ($child->title)
                                                    <label class="mb-3 text-base md:text-lg font-medium text-primary"
                                                           for="">{{ $child->title }}</label>
                                                @endif
                                                <div class="mb-7">
                                                    @foreach ($child->fields as $childFieldKey => $childField)
                                                        @if ($childField->relationLoaded(' values') && count($childField->values) > 0)
                                                            @forelse ($childField->values as $value)
                                                                <div class="mb-7 value" wire:key="{{ $childFieldKey }}">
                                                                    <livewire:field :applicant="$applicant"
                                                                                    :isEdit="$isEdit"
                                                                                    :groupKey="$customGroupKey"
                                                                                    :value="$value"
                                                                                    :key="time() . $value->id"/>
                                                                </div>
                                                            @empty
                                                                <div class="mb-7 field" wire:key="{{ $childFieldKey }}">
                                                                    <livewire:field :applicant="$applicant"
                                                                                    :isEdit="$isEdit"
                                                                                    :groupKey="$customGroupKey"
                                                                                    :field="$childField"
                                                                                    :key="time() . $childField->id"/>
                                                                </div>
                                                            @endforelse
                                                        @else
                                                            <div class="mb-7 field" wire:key="{{ $childFieldKey }}">
                                                                <livewire:field :applicant="$applicant"
                                                                                :isEdit="$isEdit"
                                                                                :groupKey="$customGroupKey"
                                                                                :field="$childField"
                                                                                :key="time() . $childField->id"/>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($group->can_add_more && $isEdit)
                                        @if ($loop->first != $loop->last || !$loop->first)
                                            <x-danger-button class="group-remove" group_key="{{ $customGroupKey }}"
                                                             wire:click="removeGroup({{ $customGroupKey }})">
                                                {{ __('Remove') }}
                                            </x-danger-button>
                                        @endif
                                        @if ($loop->last)
                                            <x-primary-button wire:click="appendGroup({{ $group->id }})">
                                                {{ $group->add_more_label ?? __('Add More') }}
                                            </x-primary-button>
                                        @endif
                                    @endif
                                </div>

                                <div class="w-full lg:w-1/2 lg:px-4 space-y-6 mt-7 lg:mt-0">
                                    {!! $group->description !!}
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endif

                <div class="lg:flex mb-10 lg:-mx-4">
                    <div class="w-full lg:w-1/2 lg:px-4 lg:max-w-md mr-auto">
                        @if (!auth()->user()->hasRole(ROLE_APPLICANT) && $isProfile)
                            <div class="flex justify-start items-baseline mb-7">
                                <div class="form-check">
                                    <input wire:model="competency_catch_up"
                                           @if ($isEdit) wire:change="handleCompetencyCatchUp" @else
                                               {{ "disabled" }}
                                           @endif class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                           type="checkbox" id="competency_catch_up">
                                    <label class="form-check-label inline-block text-gray-800"
                                           for="competency_catch_up">
                                        {{ __('Competency catch up') }}
                                    </label>
                                </div>
                            </div>
                            @if ($competency_catch_up)
                                <div>
                                    <x-jet-label for="label" class="block">
                                        {{ __('Comment') }}
                                    </x-jet-label>
                                    <div wire:ignore>
                                        <trix-editor class="prose formatted-content" x-data
                                                     x-on:trix-change="$dispatch('input', event.target.value)"
                                                     x-ref="trix" wire:model.debounce.500ms="competency_comment"
                                                     wire:key="competency_comment"></trix-editor>
                                    </div>
                                    <x-jet-input-error for="competency_comment"/>
                                </div>
                            @endif
                        @endif

                        @if(!$profileProgress && auth()->user()->hasRole(ROLE_APPLICANT))
                            <span class="text-primary text-sm">{{ __('Please fill in all required fields before submitting the form') }}</span>
                        @endif

                        @if(auth()->user()->hasRole(ROLE_APPLICANT) && $isProfile && auth()->user()->application_status == \App\Enums\ApplicationStatus::REGISTRATION_SUBMITTED)
                            <x-primary-button type="button" wire:click="submitProfileInformation"
                                              :disabled="!$profileProgress"
                                @class([
                                    'bg-opacity-50 cursor-not-allowed' => !$profileProgress,
                                ])
                            >
                                {{ __('Submit data & continue with test') }}
                            </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <livewire:applicant.modal.anonymous/>
        <livewire:applicant.modal.enrollment/>
</div>
