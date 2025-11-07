@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 font-medium text-dark focus:border-primary focus:ring-primary rounded-md shadow-sm']) }}>
