<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-button-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-button-hover focus:bg-button-dark active:bg-button-dark  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
