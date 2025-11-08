@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center gap-3 font-medium leading-5 text-primary w-full px-5 py-3 focus:border-indigo-700 transition duration-150 ease-in-out relative after:absolute after:right-0 after:top-center after:h-full after:w-1 after:bg-primary after:rounded-tl-lg after:rounded-bl-lg'

            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
