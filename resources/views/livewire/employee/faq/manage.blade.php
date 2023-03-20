<div>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <div class="-mx-4">
                <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                    <h3 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">{{ __('Faq') }}</h3>
                    <p class="mt-2 text-sm text-darkgray">
                        {{ __('This information will be displayed publicly so be careful what you share.') }}
                    </p>
                </div>
                <div class="mt-5 md:mt-0 px-4 w-full lg:w-1/2 xl:w-2/5">
                    <form wire:submit.prevent="submit" id="faqForm">
                        <div class="space-y-8 overflow-y-auto">

                            <div>
                                <x-jet-label for="name"
                                       class="block required">{{ __('Title') }}</x-jet-label>
                                <x-jet-input type="text" name="name" wire:model.defer="faq.name" id="name" :placeholder="__('Title')"
                                             class="w-full"></x-jet-input>
                                <x-jet-input-error for="faq.name"/>
                            </div>

                            <div>
                                <x-jet-label for="question"
                                       class="block required">{{ __('Question') }}</x-jet-label>
                                <x-jet-input type="text" name="question" wire:model.defer="faq.question" id="question" :placeholder="__('Question')"
                                             class="w-full"></x-jet-input>
                                <x-jet-input-error for="faq.question"/>
                            </div>

                            <div>
                                <x-jet-label for="answer"
                                       class="block required">{{ __('Answer') }}</x-jet-label>
                                <x-jet-input type="text" name="answer" wire:model.defer="faq.answer" id="answer" :placeholder="__('Answer')"
                                             class="w-full"></x-jet-input>
                                <x-jet-input-error for="faq.answer"/>
                            </div>

                            <div>
                                <x-jet-label for="name"
                                       class="block">{{ __('Assign Course') }}</x-jet-label>
                                <x-multi-select
                                    wire:model="selectedCourses"
                                    :placeholder="__('Select course')"
                                    :options='$courses'
                                    :value="$selectedCourses"
                                    key-by="id"
                                    label-by="name"
                                />
                                <x-jet-input-error for="selectedCourses"/>
                            </div>
                        </div>
                        <div class="py-3 text-right">
                            <x-primary-button type="submit"
                                              class="inline-flex">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
