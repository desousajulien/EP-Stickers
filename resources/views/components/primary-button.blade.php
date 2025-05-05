<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 btn btn-dark w-100 border border-transparent rounded-md font-semibold text-xs uppercase']) }}>
    {{ $slot }}
</button>
