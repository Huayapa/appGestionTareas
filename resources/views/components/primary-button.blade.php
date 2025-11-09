<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-3 h-12 gap-4 bg-primary border border-transparent rounded-xl text-white tracking-wide hover:bg-tertiary focus:bg-gray-700 active:bg-dark focus:outline-none focus:ring-2 focus:ring-primary transition']) }}>
    {{ $slot }}
</button>
