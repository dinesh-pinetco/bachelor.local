<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h3 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __(ucfirst($formMode)) }} {{ __($tab->name) }}
                        {{ __('Group') }}</h3>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit">
                        <div class="space-y-7">

                            <div>
                                <x-jet-label for="group_id" class="block">{{ __('Parent Group') }}
                                </x-jet-label>
                                <select
                                    class="h-11 py-2.5 pl-4 border border-gray whitespace-normal focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 focus:shadow-sm outline-none rounded-sm text-primary placeholder-gray w-full cursor-pointer"
                                    id="group_id" name="group_id" wire:model="group.parent_id">
                                    <option value=""> {{ __('Select Group') }}</option>
                                    @foreach ($groups as $groupp)
                                        <option value="{{ $groupp->id }}">{{ $groupp->internal_name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="group.parent_id"/>
                            </div>

                            <div>
                                <x-jet-label for="label" class="block required">
                                    {{ __('Internal name') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="label" :placeholder="__('Internal name')"
                                             wire:model.defer="group.internal_name" id="label"></x-jet-input>
                                <x-jet-input-error for="group.internal_name"/>
                            </div>

                            <div>
                                <x-jet-label for="label" class="block">
                                    {{ __('Title') }}
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" name="label" :placeholder="__('Title')"
                                             wire:model.defer="group.title" id="label"></x-jet-input>
                                <x-jet-input-error for="group.title"/>
                            </div>
                            @if(!$group->parent_id)
                                <div>
                                    <x-jet-label for="label" class="block">
                                        {{ __('Description') }}
                                    </x-jet-label>

                                    <div wire:ignore
                                         x-data="{ value: '{{ $group->description }}' }"
                                         x-init="$refs.trix.editor.loadHTML(value)"
                                         @trix-change="@this.updateDescription($refs.input.value)"

                                    >
                                        <input id="x" type="hidden" x-ref="input">
                                        <trix-editor placeholder="Description" class="prose text-primary placeholder-gray" x-ref="trix" input="x"></trix-editor>
                                    </div>

                                    <x-jet-input-error for="field.description"/>
                                </div>
                                <div class="flex justify-start items-baseline mb-7">
                                    <div class="form-check space-x-2">
                                        <input wire:model="group.can_add_more" wire:change="handleCanAddMore"
                                               class="flex-shrink-0 w-5 h-5 text-primary form-checkbox focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 shadow-sm outline-none"
                                               type="checkbox">
                                        <label class="form-check-label inline-block text-gray-800 -mb-0"
                                               for="flexCheckChecked">
                                            {{ __('Can Add more row') }}
                                        </label>
                                    </div>
                                </div>

                                @if($group->can_add_more)
                                    <div>
                                        <x-jet-label for="label" class="block">
                                            {{ __('Add more label') }}
                                        </x-jet-label>
                                        <x-jet-input class="w-full" type="text" name="label"
                                                     wire:model.defer="group.add_more_label" id="label"></x-jet-input>
                                        <x-jet-input-error for="group.add_more_label"/>
                                    </div>
                                @endif
                            @endif


                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit" class="inline-flex">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
