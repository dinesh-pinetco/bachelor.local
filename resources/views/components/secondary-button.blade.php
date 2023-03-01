<a {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex justify-center items-center px-4 py-2.5 lg:px-5 lg:py-3 bg-white text-primary text-center text-base border rounded-sm font-medium border-primary duration-300 hover:bg-primary hover:text-white cursor-pointer']) }} wire:loading.attr='disabled' wire:loading.class='opacity-80 cursor-wait'>
    {{ $slot }}
</a>
