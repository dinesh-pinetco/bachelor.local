<div>
    <div class="text-primary mb-10 lg:mb-16">
        <h5 class="text-base md:text-lg font-medium text-primary">
            <span>{{ __('Private Document') }}</span>
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
                {{__('Upload your private document')}}

            </label>
        </h5>

        <div class="">
            <label class="my-4 {{ $isEdit ?  'cursor-pointer' : 'cursor-not-allowed' }} relative">
                <livewire:upload-media :key="rand(22,111)"
                                       :applicant="$applicant"
                                       :extensions="$extensions"
                                       tag="private_document"
                                       model='media'
                                       :isEdit="$isEdit" >
                    <div
                        class="w-full max-w-4xl px-4 py-6 md:py-10 lg:py-16 mb-6 md:mb-10 bg-lightgray flex flex-col items-center border-2 border-dashed border-primary text-center rounded">
                        <svg class="w-10 h-10 md:w-16 md:h-16 text-primary" viewBox="0 0 60 60" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 17.5V37.5C20 38.8261 20.5268 40.0979 21.4645 41.0355C22.4021 41.9732 23.6739 42.5 25 42.5H40M20 17.5V12.5C20 11.1739 20.5268 9.90215 21.4645 8.96447C22.4021 8.02678 23.6739 7.5 25 7.5H36.465C37.128 7.50014 37.7638 7.76363 38.2325 8.2325L49.2675 19.2675C49.7364 19.7362 49.9999 20.372 50 21.035V37.5C50 38.8261 49.4732 40.0979 48.5355 41.0355C47.5979 41.9732 46.3261 42.5 45 42.5H40M20 17.5H15C13.6739 17.5 12.4021 18.0268 11.4645 18.9645C10.5268 19.9021 10 21.1739 10 22.5V47.5C10 48.8261 10.5268 50.0979 11.4645 51.0355C12.4021 51.9732 13.6739 52.5 15 52.5H35C36.3261 52.5 37.5979 51.9732 38.5355 51.0355C39.4732 50.0979 40 48.8261 40 47.5V42.5"
                                stroke="currentcolor" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <x-primary-button class="md:mt-6">{{ __('Select file') }}</x-primary-button>
                        <span class="text-sm md:mt-6">{{ $extensions->pluck('extension')->implode(',') ?? '' }}</span>
{{--                        <span class="text-sm md:mt-6">Docx</span>--}}

                    </div>
            </label>
        </div>

        {{-- documents lists --}}
        <div class="mt-6">
            <div class="space-y-1">
                @foreach ($medias as $key => $media)
                    <livewire:file-list :key="time().$key" :media="$media" :isEdit="$isEdit" showCheckbox='false' >
                @endforeach
            </div>
        </div>
    </div>
</div>
