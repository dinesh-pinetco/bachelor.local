<div>
    <div class="w-full max-w-screen-xl mx-auto">

        <div x-data="{ active: 1 }" class="space-y-4">
            @forelse ($faq as $value)
                <div x-data="{
        id: {{ $value->id }},
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region" class="border border-gray rounded-sm">
                    <h2>
                        <button x-on:click="expanded = !expanded" :aria-expanded="expanded"
                                class="flex items-center justify-between text-primary w-full font-medium text-base md:text-lg px-4 md:px-6 py-3">
                            <span class="text-primary">{{ $value->name }}</span>
                            <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                            <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                        </button>
                    </h2>

                    <div x-cloak x-show="expanded" x-collapse>
                        <div class="p-4 md:p-6 space-y-2 md:space-y-4 border-t border-gray">
                            <h6 class="text-sm md:text-base text-primary">{{ $value->question }}</h6>
                            <p class="text-xs md:text-sm text-darkgray">{{ $value->answer }}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
