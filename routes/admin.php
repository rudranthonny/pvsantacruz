<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;
use App\Livewire\ConsultarProducto;
use App\Livewire\GestionarReservas;
use App\Livewire\ModalReserva;
use App\Livewire\PacientesReservas;
use App\Livewire\Pos;
use Illuminate\Support\Facades\Route;

Route::get('', [AdminController::class,'direccionarusuario'])->middleware('can:admin.index')->name('admin.index');
Route::view("index", "administrador.index")->middleware('can:admin.index')->name("admin.tablero");
Route::view('configuracion/ajustes_sistema', 'administrador.configuracion.ajustesistema')->middleware('can:admin.configuracion.ajustesistema')->name('admin.configuracion.ajustesistema');
Route::view("moneda", "administrador.ajustes.moneda")->middleware('can:admin.moneda')->name("admin.moneda");
Route::view("almacen", "administrador.ajustes.almacen")->middleware('can:admin.almacen')->name("admin.almacen");
#almacen stock
Route::view("almacen/consultar_stock", "administrador.almacen.index")->middleware('can:admin.almacen')->name("admin.almacen_stock");
#productos
Route::view("productos", "administrador.productos.productos")->middleware('can:admin.productos')->name("admin.productos");
Route::view("marcas", "administrador.productos.marcas")->middleware('can:admin.marcas')->name("admin.marcas");
Route::view("codigo_barra", "administrador.productos.codigo_barra")->middleware('can:admin.codigo_barra')->name("admin.codigo_barra");
Route::view("categorias", "administrador.productos.categorias")->middleware('can:admin.categorias')->name("admin.categorias");
Route::view("unidades", "administrador.productos.unidades")->middleware('can:admin.unidades')->name("admin.unidades");
Route::get('search/{id}/buscar_productos', [AdminController::class, 'buscar_productos'])->middleware('can:search.buscar_productos')->name('search.buscar_productos');
Route::get('search/buscar_productos_compras',[AdminController::class,'buscar_productos_compra'])->middleware('can:search.buscar_productos_compra')->name('search.buscar_productos_compra');
Route::get('search/buscar_productos_compras2',[AdminController::class,'buscar_productos_compra2'])->middleware('can:search.buscar_productos_compra')->name('search.buscar_productos_compra2');
Route::get('search/buscar_proveedor',[AdminController::class,'buscar_proveedors'])->middleware('can:search.buscar_proveedor')->name('search.buscar_proveedor');
Route::get('search/buscar_marca',[AdminController::class,'buscar_marca'])->middleware('can:search.buscar_marca')->name('search.buscar_marca');
Route::get('search/buscar_categoria',[AdminController::class,'buscar_categoria'])->middleware('can:search.buscar_categoria')->name('search.buscar_categoria');
Route::get('producto/consulta_producto/{id}', ConsultarProducto::class)->middleware('can:admin.productos.consultar')->name('admin.productos.consultar');
Route::get('producto/consultar_barra', [AdminController::class,'consultar_barra'])->middleware('can:admin.productos.consultar_barra')->name('admin.productos.consultar_barra');
#compras
Route::view("compras", "administrador.compras.compra")->middleware('can:admin.compras')->name("admin.compras");
#personas
Route::view("cliente", "administrador.personas.cliente")->middleware('can:admin.clientes')->name("admin.clientes");
Route::get('search/buscar_cliente',[AdminController::class,'buscar_cliente'])->middleware('can:search.buscar_cliente')->name('search.buscar_cliente');
Route::view("proveedor", "administrador.personas.proveedor")->middleware('can:admin.proveedor')->name("admin.proveedor");
Route::view("usuario", "administrador.personas.usuario")->middleware('can:admin.usuario')->name("admin.usuario");
#gastos
Route::view("gastos/tgastos", "administrador.gastos.tgastos")->middleware('can:admin.gastos.tgastos')->name("admin.gastos.tgastos");
Route::view("gastos/index", "administrador.gastos.index")->middleware('can:admin.gastos.index')->name("admin.gastos.index");
#ventas
Route::get("pos", Pos::class)->middleware('can:admin.ventas.pos')->name("admin.ventas.pos");
Route::view("ventas", "administrador.ventas.index")->middleware('can:admin.ventas.reporte')->name("admin.ventas.index");
Route::view("cajas", "administrador.caja.index")->middleware('can:admin.ventas.index')->name("admin.cajas.index");
Route::view("devolucions", "administrador.devolucions.index")->middleware('can:admin.ventas.index')->name("admin.devolucions.index");
Route::view('usuarios/cambiar_password', 'administrador.personas.cambiar_password')->name('admin.usuario.cambiar');
#reportes
Route::view("reporte/ingresos_perdidas", "administrador.reportes.ingresos_perdidas")->middleware('can:admin.ventas.index')->name("admin.reportes.ingresos_perdidas");
Route::view("reporte/ventas_productos", "administrador.reportes.reporte_ventas_productos")->middleware('can:admin.ventas.index')->name("admin.reportes.ventas_productos");
Route::view("reporte/reporte_cajas", "administrador.reportes.reporte_cajas")->middleware('can:admin.ventas.index')->name("admin.reportes.reporte_cajas");
#canchas
Route::view("canchas", "administrador.canchas.index_canchas")->middleware('can:admin.canchas')->name("admin.canchas");
#reservas
Route::get("reservas/consultar/{id}", GestionarReservas::class)->middleware('can:admin.reservas')->name('admin.reservas');
Route::get("reservas/pacientes/{id}", PacientesReservas::class)->middleware('can:admin.reservas')->name('admin.pacientes.reservas');
Route::view("reservas/reportes", "administrador.reservas.index_reservas_reporte")->middleware('can:admin.reservas')->name("admin.reservas_reporte");
Route::get("api/reservas", [ReservaController::class, 'apiReservas']);
Route::get("reservas/modificar/{id}", ModalReserva::class)->middleware('can:admin.reservas')->name('admin.reservas_modificar');
#logs
Route::view('logs/index', 'administrador.logs.log_index')->middleware('can:admin.log.titulo')->name('admin.logs.index');
