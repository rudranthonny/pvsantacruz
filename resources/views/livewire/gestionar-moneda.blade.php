<div>
    <p>Welcome to this beautiful admin panel.</p>
    <h3>Aqui va ir las monedas</h3>
    @foreach ($monedas as $moneda)
        <table>
            <tr>
                <td><p>{{$moneda->codigo_moneda}}</p></td>
                <td><p>{{$moneda->nombre_moneda}}</p></td>
                <td><p>{{$moneda->simbolo}}</p></td>
                <td><button wire:click="editar({{$moneda->id}})">Editar</button></td>
            </tr>
        </table>
    @endforeach
    {{-- Success is as dangerous as failure. --}}
</div>
