@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-accent-dark focus:border-accent-dark focus:ring-accent-dark rounded-md']) }}>
