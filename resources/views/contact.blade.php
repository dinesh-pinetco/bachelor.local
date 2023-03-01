<x-app-layout>
    <div class="px-4 md:px-6 w-full max-w-screen-lg mx-auto">
        <h2 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
            {{ __('Support') }}
        </h2>
        <div class="flex flex-wrap justify-between items-start -mx-4 ">
            <div class="p-4 w-full order-1 lg:order-0 lg:w-1/2 xl:w-2/5">
                <form action="{{ route('contact-us.mail') }}" method="POST">
                    @csrf
                    <h4 class="mb-4 md:mb-6 text-xl font-medium text-primary">{{ __('Write us a Message') }}</h4>
                    <x-jet-label value="{{ __('News') }}" />
                    <div class="max-w-sm w-full">
                        <textarea name="message" placeholder="{{ __('Enter your message') }}" required
                            class="w-full border border-gray focus:border-primary-light ring-4 ring-transparent focus:ring-4 focus:ring-primary focus:ring-opacity-20 outline-none rounded-sm focus:shadow-sm text-gray placeholder-gray resize-none shadow-sm"
                            rows="8"></textarea>
                        <input type="hidden" name="email" value="{{ $professor->model->email }}">
                    </div>
                    <div class="mt-4 md:mt-6">
                        <x-primary-button>
                            {{ __('Send Message') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="p-4 w-full order-0 lg:order-1 lg:w-1/2 xl:w-2/5">
                <div class="mb-12 w-32 h-32 md:w-40 md:h-40 lg:w-48 lg:h-48 rounded-full overflow-hidden">
                    <img src="{{ $professor->model->profile_photo_url }}"
                        class="w-full h-full object-center object-cover" alt="User">
                </div>
                <h4 class="mb-6 text-primary text-xl md:text-2xl">{{ $professor->model->name }}</h4>
                <div class="mb-6 flex items-center space-x-2 md:space-x-4">
                    <span>
                        <svg class="stroke-current w-6 h-6" fill="none">
                            <path
                                d="M3.586 3.586A2 2 0 003 5v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.279a1 1 0 00-.684-.949l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.516l2.257-1.13a1 1 0 00.502-1.21L9.228 3.684A1 1 0 008.28 3H5a2 2 0 00-1.414.586z"
                                stroke="#003A79" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <a href="tel:+49 (0) 4121 4090-0"
                        class="text-primary font-bold hover:underline">{{ $professor->model->phone }}</a>
                </div>
                <div class="mb-6 flex items-center space-x-2 md:space-x-4">
                    <svg class="stroke-current w-6 h-6" fill="none">
                        <path
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            stroke="#003A79" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="mailto:{{ $professor->model->email }}"
                        class="text-primary font-bold hover:underline">{{ $professor->model->email }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
