<div class="relative max-w-screen-xl mx-auto">

    <livewire:tabs :applicant="$applicant??''" />

    <div class="relative flex flex-wrap">
        <div class="absolute left-0 flex-shrink-0 w-20 md:w-32 lg:w-40 2xl:w-64 lg:static">
            <div class="flex items-center justify-center py-8 lg:py-6 xl:py-0">
                <svg class="w-16 h-16 lg:w-24 xl:w-32 lg:h-24 xl:h-32 text-primary" viewBox="0 0 120 120" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M35.0004 80C30.0754 80.0055 25.3216 78.1936 21.6497 74.9116C17.9778 71.6295 15.6459 67.108 15.1009 62.2133C14.5559 57.3186 15.836 52.395 18.696 48.3856C21.5561 44.3762 25.7949 41.563 30.6004 40.485C29.21 34.0004 30.4525 27.2292 34.0546 21.6607C37.6567 16.0923 43.3233 12.1829 49.8079 10.7925C56.2924 9.40209 63.0637 10.6446 68.6321 14.2467C74.2005 17.8488 78.11 23.5154 79.5004 30H80.0004C86.2001 29.9938 92.181 32.2914 96.782 36.4469C101.383 40.6023 104.276 46.3191 104.899 52.4875C105.522 58.6559 103.831 64.8357 100.154 69.8274C96.4768 74.819 91.0761 78.2663 85.0004 79.5M75.0004 65L60.0004 50M60.0004 50L45.0004 65M60.0004 50V110"
                        stroke="currentcolor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <div class="relative flex-grow w-1/3 text-primary">
            <div class="w-full flex flex-wrap items-center justify-end md:justify-between">
                <h3 class="ml-20 text-2xl md:ml-32 lg:ml-0 my-7 lg:my-10 md:text-3xl">
                    {{ __('Please upload your documents') }}</h3>
                    @if(auth()->user()->hasRole(ROLE_APPLICANT))
                        <a class="w-10 h-10 mb-5 md:my-0 flex items-center justify-center bg-primary hover:bg-opacity-80 rounded-sm" href="application/motivation">
                            <svg  class="w-4 h-4 stroke-current text-white flex-shrink-0" width="25" height="25" viewBox="0 0 24 24" stroke-width="2.50" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentcolor">
                                <path d="M21 12H3m0 0l8.5-8.5M3 12l8.5 8.5" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                @endif
            </div>



            @foreach ($documents as $document)
                <div class="mb-10 text-primary lg:mb-16">
                    <h5 class="text-base font-medium md:text-lg text-primary">
                        <span>{{ __($document->name) }}</span>
                        @if ($document->is_required)
                            <span class="m-2 text-red">*</span>
                        @endif
                        <div class="hidden ml-10">
                            <svg class="w-9 h-9 text-primary" viewBox="0 0 36 36" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.5 18L16.1667 21.6667L23.5 14.3333M34.5 18C34.5 20.1668 34.0732 22.3124 33.244 24.3143C32.4148 26.3161 31.1994 28.1351 29.6673 29.6673C28.1351 31.1994 26.3161 32.4148 24.3143 33.244C22.3124 34.0732 20.1668 34.5 18 34.5C15.8332 34.5 13.6876 34.0732 11.6857 33.244C9.68385 32.4148 7.8649 31.1994 6.33274 29.6673C4.80057 28.1351 3.58519 26.3161 2.75599 24.3143C1.92678 22.3124 1.5 20.1668 1.5 18C1.5 13.6239 3.23839 9.42709 6.33274 6.33274C9.42709 3.23839 13.6239 1.5 18 1.5C22.3761 1.5 26.5729 3.23839 29.6673 6.33274C32.7616 9.42709 34.5 13.6239 34.5 18Z"
                                    stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <label class="w-full mt-1">
                            {{ $document->description }}
                        </label>
                    </h5>

                    <div class="max-w-4xl">
                        <label class="my-4 {{ $isEdit ?  'cursor-pointer' : 'cursor-not-allowed' }} relative">
                            <livewire:upload-media
                                :key="$document->id"
                                :applicant="$applicant"
                                :extensions="$document->extensions"
                                :tag="$document->name"
                                :id="$document->id"
                                model='document'
                                :isEdit="!$isEdit"/>
                            <div
                                class="flex flex-col items-center w-full px-4 py-6 mb-6 text-center border-2 border-dashed rounded md:py-10 lg:py-16 md:mb-10 bg-lightgray border-primary">
                                <svg class="w-10 h-10 md:w-16 md:h-16 text-primary" viewBox="0 0 60 60" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 17.5V37.5C20 38.8261 20.5268 40.0979 21.4645 41.0355C22.4021 41.9732 23.6739 42.5 25 42.5H40M20 17.5V12.5C20 11.1739 20.5268 9.90215 21.4645 8.96447C22.4021 8.02678 23.6739 7.5 25 7.5H36.465C37.128 7.50014 37.7638 7.76363 38.2325 8.2325L49.2675 19.2675C49.7364 19.7362 49.9999 20.372 50 21.035V37.5C50 38.8261 49.4732 40.0979 48.5355 41.0355C47.5979 41.9732 46.3261 42.5 45 42.5H40M20 17.5H15C13.6739 17.5 12.4021 18.0268 11.4645 18.9645C10.5268 19.9021 10 21.1739 10 22.5V47.5C10 48.8261 10.5268 50.0979 11.4645 51.0355C12.4021 51.9732 13.6739 52.5 15 52.5H35C36.3261 52.5 37.5979 51.9732 38.5355 51.0355C39.4732 50.0979 40 48.8261 40 47.5V42.5"
                                        stroke="currentcolor" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                                <x-primary-button class="md:mt-6">{{ __('Select file') }}</x-primary-button>
                                <span class="text-sm md:mt-6">{{ $document->extensions->pluck('extension')->implode(',') ?? '' }}</span>

                            </div>
                        </label>
                    </div>

                    {{-- documents lists --}}
                    <div class="mt-6">
                        <div class="space-y-1">
                            @foreach ($document->medias as $key => $media)
                                <livewire:file-list :key="time().$key" :media="$media" :isEdit="!$isEdit" showCheckbox="false" >
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            @if(auth()->user()->hasAnyRole([ROLE_ADMIN,ROLE_SUPER_ADMIN,ROLE_EMPLOYEE]))
                <livewire:private-document :applicant="$applicant" />
            @endif
        </div>
    </div>
</div>
