@props([
'type' => '',
'active' => false,
'size' => ''
])

@if($type === 'profile')
    <svg @class([
    'w-16 h-16 lg:w-24 xl:w-32 lg:h-24 xl:h-32 text-primary' => $size == 'large',
    '-ml-0.5 mr-2 h-5 w-5' => $size === 'small',
    'text-gray-400 group-hover:text-gray-500' => !$active,
    'text-white' => $active
    ]) xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
    </svg>
@elseif($type === 'career')

    <svg @class([
    '-ml-0.5 mr-2 h-5 w-5' => $size === 'small',
    'w-16 h-16 lg:w-24 xl:w-32 lg:h-24 xl:h-32 text-primary' => $size == 'large',
    'text-gray-400 group-hover:text-gray-500' => !$active,
    'text-white' => $active
    ]) viewBox="0 0 120 120" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M75.8601 34.9999L42.9301 67.9299C41.975 68.8524 41.2132 69.9559 40.6891 71.1759C40.165 72.3959 39.8891 73.7081 39.8776 75.0359C39.8661 76.3637 40.1191 77.6805 40.6219 78.9095C41.1247 80.1384 41.8672 81.255 42.8061 82.1939C43.7451 83.1328 44.8616 83.8753 46.0906 84.3781C47.3195 84.881 48.6363 85.134 49.9641 85.1224C51.2919 85.1109 52.6041 84.835 53.8241 84.311C55.0442 83.7869 56.1476 83.025 57.0701 82.0699L89.1401 49.1399C92.7833 45.3679 94.7992 40.3158 94.7536 35.0719C94.708 29.828 92.6046 24.8117 88.8965 21.1036C85.1883 17.3954 80.1721 15.292 74.9281 15.2465C69.6842 15.2009 64.6321 17.2168 60.8601 20.8599L28.7851 53.7849C23.1585 59.4115 19.9976 67.0428 19.9976 74.9999C19.9976 82.9571 23.1585 90.5884 28.7851 96.2149C34.4117 101.842 42.0429 105.002 50.0001 105.002C57.9573 105.002 65.5885 101.842 71.2151 96.2149L102.5 64.9999"
        stroke="currentcolor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
@elseif($type === 'motivation')
    <svg @class([
    '-ml-0.5 mr-2 h-5 w-5' => $size === 'small',
    'w-16 h-16 lg:w-24 xl:w-32 lg:h-24 xl:h-32 text-primary' => $size == 'large',
    'text-gray-400 group-hover:text-gray-500' => !$active,
    'text-white' => $active
    ]) viewBox="0 0 120 120" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M16.7127 38.8895C17.8435 36.1596 19.5008 33.6792 21.5902 31.5899C23.6795 29.5006 26.1599 27.8432 28.8898 26.7125C31.6196 25.5817 34.5454 24.9997 37.5002 24.9997C40.455 24.9997 43.3808 25.5817 46.1106 26.7125C48.8405 27.8432 51.3209 29.5006 53.4102 31.5899L60.0002 38.1799L66.5902 31.5899C70.8098 27.3703 76.5328 24.9998 82.5002 24.9998C88.4676 24.9998 94.1906 27.3703 98.4102 31.5899C102.63 35.8095 105 41.5325 105 47.4999C105 53.4673 102.63 59.1903 98.4102 63.4099L60.0002 101.82L21.5902 63.4099C19.5008 61.3206 17.8435 58.8402 16.7127 56.1104C15.582 53.3805 15 50.4547 15 47.4999C15 44.5452 15.582 41.6193 16.7127 38.8895Z"
        stroke="currentcolor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
@endif

