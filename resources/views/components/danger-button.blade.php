<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-3 h-12 gap-4 bg-red-600 rounded-md font-semibold text-white tracking-wide hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
