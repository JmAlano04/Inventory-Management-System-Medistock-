@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-text-base']) }}>
    {{ $value ?? $slot }}
</label>
