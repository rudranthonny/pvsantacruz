<a href="/">
    @if (asset(App\Models\Configuracion::find(1)->logo))
    <img src="{{ asset(App\Models\Configuracion::find(1)->logo) }}" width="256">
    @endif
</a>
