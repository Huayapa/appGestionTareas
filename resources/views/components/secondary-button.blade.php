<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-3 h-12 gap-4 bg-white border border-transparent rounded-xl text-dark tracking-wide hover:bg-tertiary hover:text-white active:bg-dark focus:outline-none focus:ring-2 focus:ring-gray-300 transition']) }}>
    {{ $slot }}
</button>
