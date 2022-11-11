<x-app-layout>
    <div class="xl:px-20 w-full max-w-screen-xl mx-auto">
        <div>
            <h1 class="mb-5 md:mb-9 text-primary text-2xl md:text-3xl lg:text-5xl font-light leading-tight">
                {{__('Hello,') }} {{ auth()->user()->full_name }}!
            </h1>
            <h6 class="text-base md:text-xl font-medium text-primary">
                {{__('Your next steps')}}
            </h6>
        </div>
        <div class="my-2 -mx-2 sm:-mx-6 md:-mx-4 xl:-mx-0 flex flex-wrap justify-between mx-auto">
            <a href="{{ route('application.index',['tab' => 'profile']) }}"
               class="flex flex-col py-4 md:py-12 px-2 sm:px-6 md:px-4 xl:px-0 max-w-sm w-1/2 cursor-pointer">
                <svg class="flex-shrink-0 mx-auto h-10 w-10 sm:h-14 sm:w-14 lg:w-20 lg:h-20 xl:w-28 xl:h-28"
                     width="120" height="120"
                     viewBox="0 0 120 120"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M74.1421 49.1421C77.8929 45.3914 80 40.3043 80 35C80 29.6957 77.8929 24.6086 74.1421 20.8579C70.3914 17.1071 65.3043 15 60 15C54.6957 15 49.6086 17.1071 45.8579 20.8579C42.1071 24.6086 40 29.6957 40 35C40 40.3043 42.1071 45.3914 45.8579 49.1421C49.6086 52.8929 54.6957 55 60 55C65.3043 55 70.3914 52.8929 74.1421 49.1421Z"
                        stroke="#003A79" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path
                        d="M35.2513 80.2513C41.815 73.6875 50.7174 70 60 70C69.2826 70 78.185 73.6875 84.7487 80.2513C91.3125 86.815 95 95.7174 95 105H25C25 95.7174 28.6875 86.815 35.2513 80.2513Z"
                        stroke="#003A79" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p class="flex-grow px-6 lg:px-0 text-sm md:text-lg lg:text-xl text-primary font-medium mt-2 text-center">
                    {{__('Complete profile')}}
                </p>
                <x-progress-bar :progress="$profileProgress"></x-progress-bar>
            </a>
            <a href="{{ route('application.index',['tab' => 'motivation']) }}"
               class="flex flex-col py-4 md:py-12 px-2 sm:px-6 md:px-4 xl:px-0 max-w-sm w-1/2 cursor-pointer">
                <svg class="flex-shrink-0 mx-auto h-10 w-10 sm:h-14 sm:w-14 lg:w-20 lg:h-20 xl:w-28 xl:h-28" width="120" height="120"
                     viewBox="0 0 120 120"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.7127 38.8895C17.8434 36.1596 19.5008 33.6792 21.5901 31.5899C23.6795 29.5006 26.1598 27.8432 28.8897 26.7125C31.6195 25.5817 34.5454 24.9997 37.5001 24.9997C40.4549 24.9997 43.3807 25.5817 46.1106 26.7125C48.8404 27.8432 51.3208 29.5006 53.4101 31.5899L60.0001 38.1799L66.5901 31.5899C70.8097 27.3703 76.5327 24.9998 82.5001 24.9998C88.4675 24.9998 94.1905 27.3703 98.4101 31.5899C102.63 35.8095 105 41.5325 105 47.4999C105 53.4673 102.63 59.1903 98.4101 63.4099L60.0001 101.82L21.5901 63.4099C19.5008 61.3206 17.8434 58.8402 16.7127 56.1104C15.5819 53.3805 14.9999 50.4547 14.9999 47.4999C14.9999 44.5452 15.5819 41.6193 16.7127 38.8895Z"
                        stroke="#003A79" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <p class="flex-grow px-6 lg:px-0 text-sm md:text-lg lg:text-xl text-primary font-medium mt-2 text-center">
                    {{__('Specify motivation')}}
                </p>
                <x-progress-bar :progress="$motivateProgress"></x-progress-bar>
            </a>
            <a href="{{ route('application.index',['tab' => 'industries']) }}"
               class="flex flex-col py-4 md:py-12 px-2 sm:px-6 md:px-4 xl:px-0 max-w-sm w-1/2 cursor-pointer">
                <svg class="flex-shrink-0 mx-auto h-10 w-10 sm:h-14 sm:w-14 lg:w-20 lg:h-20 xl:w-28 xl:h-28" width="120" height="120"
                     viewBox="0 0 120 120"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M75.8601 34.9999L42.9301 67.9299C41.975 68.8524 41.2132 69.9558 40.6891 71.1759C40.165 72.3959 39.8891 73.7081 39.8776 75.0359C39.8661 76.3637 40.1191 77.6805 40.6219 78.9094C41.1247 80.1384 41.8672 81.2549 42.8061 82.1939C43.7451 83.1328 44.8616 83.8753 46.0906 84.3781C47.3195 84.8809 48.6363 85.134 49.9641 85.1224C51.2919 85.1109 52.6041 84.835 53.8241 84.3109C55.0442 83.7868 56.1476 83.025 57.0701 82.0699L89.1401 49.1399C92.7833 45.3679 94.7992 40.3158 94.7536 35.0719C94.708 29.8279 92.6046 24.8117 88.8965 21.1035C85.1883 17.3954 80.1721 15.292 74.9281 15.2464C69.6842 15.2009 64.6321 17.2167 60.8601 20.8599L28.7851 53.7849C23.1585 59.4115 19.9976 67.0427 19.9976 74.9999C19.9976 82.9571 23.1585 90.5883 28.7851 96.2149C34.4117 101.841 42.0429 105.002 50.0001 105.002C57.9573 105.002 65.5885 101.841 71.2151 96.2149L102.5 64.9999"
                        stroke="#003A79" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <p class="flex-grow px-6 lg:px-0 text-sm md:text-lg lg:text-xl text-primary font-medium mt-2 text-center">
                    {{__('Complete career')}}
                </p>
                <x-progress-bar :progress="$careerProgress"></x-progress-bar>
            </a>
            <a href="{{ route('documents.index') }}"
               class="flex flex-col py-4 md:py-12 px-2 sm:px-6 md:px-4 xl:px-0 max-w-sm w-1/2 cursor-pointer">
                <svg class="flex-shrink-0 mx-auto h-10 w-10 sm:h-14 sm:w-14 lg:w-20 lg:h-20 xl:w-28 xl:h-28" width="120" height="120"
                     viewBox="0 0 120 120"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M35.0003 80C30.0754 80.0055 25.3216 78.1937 21.6497 74.9116C17.9777 71.6295 15.6459 67.108 15.1009 62.2134C14.5558 57.3187 15.836 52.395 18.696 48.3856C21.556 44.3762 25.7948 41.563 30.6003 40.485C29.2099 34.0005 30.4524 27.2292 34.0545 21.6608C37.6566 16.0923 43.3233 12.1829 49.8078 10.7925C56.2924 9.40212 63.0636 10.6446 68.6321 14.2467C74.2005 17.8489 78.1099 23.5155 79.5003 30H80.0003C86.2001 29.9938 92.181 32.2914 96.782 36.4469C101.383 40.6023 104.276 46.3192 104.899 52.4875C105.522 58.6559 103.831 64.8358 100.154 69.8274C96.4767 74.819 91.0761 78.2663 85.0003 79.5M75.0003 65L60.0003 50M60.0003 50L45.0003 65M60.0003 50V110"
                        stroke="#003A79" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <p class="flex-grow px-6 lg:px-0 text-sm md:text-lg lg:text-xl text-primary font-medium mt-2 text-center">
                    {{__('Upload documents')}}
                </p>
                <x-progress-bar :progress="$documentProgress"></x-progress-bar>
            </a>
        </div>
    </div>
</x-app-layout>
