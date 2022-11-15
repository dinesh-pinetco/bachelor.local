<div class="max-w-screen-xl mx-auto">
    @role(ROLE_APPLICANT)
        @if(!$isProfile)
            <livewire:tabs :applicant="$applicant"/>
        @else
            <div class="w-full max-w-screen-xl mx-auto">
                <div class="flex">
                    <div class="hidden lg:block flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64"></div>
                    <h1
                        class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
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
            <h6 class="text-2xl md:text-3xl font-medium text-primary {{ $isProfile ? 'mb-5 md:mb-9' : 'ml-20 md:ml-32 lg:ml-0 my-7 lg:my-10' }}">
                {{ $tab->description }}</h6>
            @if (!empty($parentCustomGroups))
                @foreach ($parentCustomGroups as $parentCustomGroupKey => $parentCustomGroup)
                    @foreach ($parentCustomGroup as $groupKey => $group)
                        @php
                            $customGroupKey = $applicant->id . $parentCustomGroupKey . $groupKey;
                        @endphp
                        <div class="lg:flex mb-10 lg:-mx-4" id="group-key-{{ $customGroupKey }}" wire:key="{{ $customGroupKey }}">
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
                                                        :groupKey="$customGroupKey" :value="$value" :key="time() . $value->id" />
                                                </div>
                                            @empty
                                                <div class="field" wire:key="{{ $fieldKey }}">
                                                    <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                        :groupKey="$customGroupKey" :field="$field" :key="time() . $field->id" />
                                                </div>
                                            @endforelse
                                        @else
                                            <div class="field" wire:key="{{ $fieldKey }}">
                                                <livewire:field :applicant="$applicant" :isEdit="$isEdit" :groupKey="$customGroupKey"
                                                    :field="$field" :key="time() . $field->id" />
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
                                                    @if ($childField->relationLoaded('values') && count($childField->values) > 0)
                                                        @forelse ($childField->values as $value)
                                                            <div class="mb-7 value"
                                                                wire:key="{{ $childFieldKey }}">
                                                                <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                    :groupKey="$customGroupKey" :value="$value"
                                                                    :key="time() . $value->id" />
                                                            </div>
                                                        @empty
                                                            <div class="mb-7 field"
                                                                wire:key="{{ $childFieldKey }}">
                                                                <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                    :groupKey="$customGroupKey" :field="$childField"
                                                                    :key="time() . $childField->id" />
                                                            </div>
                                                        @endforelse
                                                    @else
                                                        <div class="mb-7 field" wire:key="{{ $childFieldKey }}">
                                                            <livewire:field :applicant="$applicant" :isEdit="$isEdit"
                                                                :groupKey="$customGroupKey" :field="$childField"
                                                                :key="time() . $childField->id" />
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($group->can_add_more && $isEdit)
                                    @if ($loop->first != $loop->last || !$loop->first)
                                        <x-danger-button class="group-remove" group_key="{{ $customGroupKey }}" wire:click="removeGroup({{ $customGroupKey }})"
                                            wire:loading.attr="disabled">
                                            {{ __('Remove') }}
                                        </x-danger-button>
                                    @endif
                                    @if ($loop->last)
                                        <x-primary-button wire:click="appendGroup({{ $group->id }})"
                                                          wire:loading.attr="disabled">
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
                                <input wire:model="applicant.competency_catch_up" @if ($isEdit) wire:change="handleCompetencyCatchUp" @else {{ "disabled" }} @endif
                                    class="flex-shrink-0 w-5 h-5 mt-1 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                    type="checkbox">
                                <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
                                    {{ __('Competency catch up') }}
                                </label>
                            </div>
                        </div>
                        @if ($applicant->competency_catch_up)
                            <div>
                                <x-jet-label for="label" class="block">
                                    {{ __('Comment') }}
                                </x-jet-label>
                                <div wire:ignore>
                                    <trix-editor
                                        class="prose formatted-content"
                                        x-data
                                        x-on:trix-change="$dispatch('input', event.target.value)"
                                        x-ref="trix"
                                        wire:model.debounce.500ms="applicant.competency_comment"
                                        wire:key="applicant.competency_comment"
                                    ></trix-editor>
                                </div>
                                <x-jet-input-error for="applicant.competency_comment"/>
                            </div>
                        @endif
                    @endif

                    @if(auth()->user()->hasRole(ROLE_APPLICANT) && $isProfile && auth()->user()->application_status == \App\Enums\ApplicationStatus::REGISTRATION_SUBMITTED)
                        <x-primary-button type="button"
                                          wire:click="submitProfileInformation"
                                          wire:loading.attr="disabled">
                            {{ __('Submit data & continue with test') }}
                        </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
