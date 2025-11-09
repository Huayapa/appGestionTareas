@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center justify-center xl:justify-start gap-5 font-medium leading-5 text-primary sm:w-full px-6 sm:px-5 xl:px-6 py-5 sm:py-4 transition duration-150 ease-in-out relative after:absolute after:top-0 after:right-center after:h-1 after:w-20 after:rounded-bl-lg after:rounded-br-lg sm:after:right-0 sm:after:top-center sm:after:h-[80%] sm:after:w-1 after:bg-primary sm:after:rounded-tl-lg sm:after:rounded-bl-lg'
            : 'inline-flex items-center justify-center xl:justify-start gap-5 font-medium leading-5 sm:w-full px-6 sm:px-5 xl:px-6 py-5 sm:py-4 transition duration-150 ease-in-out relative hover:bg-tertiary opacity-60';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
