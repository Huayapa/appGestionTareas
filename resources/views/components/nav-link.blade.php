@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center gap-4 font-medium leading-5 text-primary w-full px-6 py-4 transition duration-150 ease-in-out relative after:absolute after:right-0 after:top-center after:h-[80%] after:w-1 after:bg-primary after:rounded-tl-lg after:rounded-bl-lg'

            : 'inline-flex items-center gap-4 font-medium leading-5 w-full px-6 py-4 transition duration-150 ease-in-out relative hover:bg-tertiary opacity-60';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
