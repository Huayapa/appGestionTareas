@props([
    'disabled' => false,
    'dark' => null,
])

@php
    $darkClasses = '';
    
    if (isset($dark)) {
        $darkClasses =
            'bg-secondary border-transparent text-light rounded-bl-none rounded-br-none border-b-primary focus:rounded-bl-md focus:rounded-br-md';
    }
@endphp

<textarea @disabled($disabled)
    {{ $attributes->merge(['class' => "border-gray-300 text-dark focus:border-primary focus:ring-primary rounded-md shadow-sm $darkClasses"]) }}>{{ $slot }}</textarea>
