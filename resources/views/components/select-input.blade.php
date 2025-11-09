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


<select @disabled($disabled)
    {{ $attributes->merge(['class' => "border-gray-300 focus:border-primary focus:ring-primary text-dark rounded-md shadow-sm disabled:bg-gray-200 open-select-input $darkClasses"]) }}>
    {{ $slot }}
</select>

<style>
    .open-select-input:open {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
</style>