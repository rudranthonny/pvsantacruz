<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
    <link href="{{asset('css/estilo_reporte.css')}}" rel="stylesheet" >
</head>
<body class="m-1 fs-12">
    <div>
        <div class="col-12">
            <table>
                <tr>
                    <td>
                        <h1 class="modal-title fs-5" id="modalReporteCajaLabel">Reporte de Productos</h1><br>
                        <b>Productos en total : {{$lista_productos->count()}}</b>
                    </td>
                    <td><img src="{{asset($configuracion->logo)}}" alt="" width="128px" height="128px"></td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="encabezado-dark" style="width:120px;">Tipo</th>
                    <th class="encabezado-dark" style="width:200px;">Designacion</th>
                    <th class="encabezado-dark" style="width:140px;">Codigo</th>
                    <th class="encabezado-dark" style="width:120px;">Marca</th>
                    <th class="encabezado-dark" style="width:120px;">Categoria</th>
                    <th class="encabezado-dark" style="width:80px;">Precio</th>
                    <th class="encabezado-dark" style="width:80px;">Unidad</th>
                    <th class="encabezado-dark" style="width:50px;">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lista_productos as $produc)
                    <tr>
                        <td class="encabezado-body">{{ $produc->tipo }}</td>
                        <td class="encabezado-body">{{ $produc->designacion }}</td>
                        <td class="encabezado-body">{{ $produc->codigo }}</td>
                        <td class="encabezado-body">{{ optional($produc->marca)->name }}</td>
                        <td class="encabezado-body">{{ optional($produc->categoria)->name }}</td>
                        <td class="encabezado-body">{{$configuracion->moneda->simbolo}}{{ $produc->precio }}</td>
                        <td class="encabezado-body">{{ optional($produc->cunitario)->name }}</td>
                        <td class="encabezado-body">{{ $produc->obtener_cantidad }}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>


