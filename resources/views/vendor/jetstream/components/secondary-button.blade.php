<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-4 bg-white font-medium text-base text-primary shadow-sm hover:text-white hover:bg-primary focus:outline-none focus:border-primary focus:ring focus:ring-primary active:text-primary active:bg-light-gray disabled:opacity-25 transition duration-200 ease-in-out']) }}>
    {{ $slot }}
</button>
