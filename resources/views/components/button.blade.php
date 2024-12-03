<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-lg boton-container']) }}>
    {{ $slot }}
</button>
