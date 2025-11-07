@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-light opacity-80']) }}>
    {{ $value ?? $slot }}
</label>
