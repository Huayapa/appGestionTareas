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

<input @disabled($disabled)
    {{ $attributes->merge(['class' => "border-gray-300 text-dark focus:border-primary focus:ring-primary rounded-md shadow-sm $darkClasses"]) }}>


@if ($attributes['type'] === 'date')
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(60%) sepia(80%) saturate(500%) hue-rotate(90deg);
            cursor: pointer;
        }
    </style>
@endif
