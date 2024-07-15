@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-white font-medium mb-1']) }}>
    {{ $value ?? $slot }}
</label>
