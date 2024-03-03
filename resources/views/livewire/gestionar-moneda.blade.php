<div>
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3">Gestionar Monedas</span>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <!--cuerpo-->
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Almacenes</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalMoneda">Añadir</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <caption class="caption-top">Lista de Monedas</caption>
                            <thead class="table-light">
                                <tr>
                                    <th>Codigo Moneda</th>
                                    <th>Nombre Moneda</th>
                                    <th>Simbolo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($monedas as $moneda)
                                    <tr>
                                        <td>{{ $moneda->codigo_moneda }}</td>
                                        <td>{{ $moneda->nombre_moneda }}</td>
                                        <td>{{ $moneda->simbolo }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalMoneda"
                                                wire:click="editar('{{ $moneda->id }}')">editar</button>
                                            <button class="btn btn-danger">eliminar</button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td>Codigo Moneda</td>
                                    <td>Nombre Moneda</td>
                                    <td>Simbolo</td>
                                    <td>Accion</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @include('administrador.ajustes.parts.moneda-modal')
                </div>
            </div>
        </div>
    </div>
    {{-- Success is as dangerous as failure. --}}

                {{--<td><p>{{$moneda->codigo_moneda}}</p></td>
                <td><p>{{$moneda->nombre_moneda}}</p></td>
                <td><p>{{$moneda->simbolo}}</p></td>
                <td><button wire:click="editar({{$moneda->id}})">Editar</button></td>--}}
</div>
