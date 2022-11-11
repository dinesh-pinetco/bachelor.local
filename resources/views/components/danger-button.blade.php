<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex justify-center items-center px-4 py-2 bg-red text-white text-center text-base border font-medium tracking-wide rounded-sm border-red opacity-80 hover:opacity-100 ']) }}>
    {{ $slot }}
</button>
