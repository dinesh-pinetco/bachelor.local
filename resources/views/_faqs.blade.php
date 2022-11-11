<x-app-layout>
    <div class="max-w-screen-xl w-full mx-auto">
        <div class="-mx-4">
            <div class="px-4 mb-7 md:mb-12 lg:mb-16">
                <h2 class="text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                    {{ __('Faq') }}</h2>
                <p class="mt-2 text-sm text-darkgray">
                    {{ __('This information will be displayed publicly so be careful what you share.') }}
                </p>
            </div>
            <div class="px-4 w-full max-w-screen-xl mx-auto">

                <div x-data="{ active: 1 }" class="space-y-4">
                    <div x-data="{
        id: 1,
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region" class="border border-gray rounded-md">
                        <h2>
                            <button
                                x-on:click="expanded = !expanded"
                                :aria-expanded="expanded"
                                class="flex items-center justify-between text-primary w-full font-medium text-lg md:text-xl px-4 md:px-6 py-3"
                            >
                                <span class="text-primary">Name</span>
                                <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                                <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                            </button>
                        </h2>

                        <div x-cloak x-show="expanded" x-collapse>
                            <div class="p-4 md:p-6 space-y-2 md:space-y-4 border-t border-gray">
                                <h6 class="text-base md:text-lg text-primary font-medium">Question 1</h6>
                                <p class="text-sm md:text-base text-darkgray">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In magnam
                                    quod natus
                                    deleniti architecto eaque consequuntur ex, illo neque iste repellendus modi, quasi
                                    ipsa
                                    commodi
                                    saepe? Provident ipsa nulla earum.</p>
                            </div>
                        </div>
                    </div>

                    <div x-data="{
        id: 2,
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region" class="border border-gray rounded-md">
                        <h2>
                            <button
                                x-on:click="expanded = !expanded"
                                :aria-expanded="expanded"
                                class="flex items-center justify-between text-primary w-full font-medium text-lg md:text-xl px-4 md:px-6 py-3"
                            >
                                <span class="text-primary">Name 2</span>
                                <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                                <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                            </button>
                        </h2>

                        <div x-cloak x-show="expanded" x-collapse>
                            <div class="p-4 md:p-6 space-y-2 md:space-y-4 border-t border-gray">
                                <h6 class="text-base md:text-lg text-primary font-medium">Question 2</h6>
                                <p class="text-sm md:text-base text-darkgray">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In magnam
                                    quod natus
                                    deleniti architecto eaque consequuntur ex, illo neque iste repellendus modi, quasi
                                    ipsa
                                    commodi
                                    saepe? Provident ipsa nulla earum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
