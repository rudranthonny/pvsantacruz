<?php

use App\Http\Controllers\AdminController;
use App\Livewire\ConsultarProducto;
use App\Livewire\Pos;
use Illuminate\Support\Facades\Route;

Route::get('', [AdminController::class,'direccionarusuario'])->middleware('can:admin.index')->name('admin.index');
Route::view('configuracion/ajustes_sistema', 'administrador.configuracion.ajustesistema')->middleware('can:admin.configuracion.ajustesistema')->name('admin.configuracion.ajustesistema');
Route::view("moneda", "administrador.ajustes.moneda")->middleware('can:admin.moneda')->name("admin.moneda");
Route::view("almacen", "administrador.ajustes.almacen")->middleware('can:admin.almacen')->name("admin.almacen");
#productos
Route::view("productos", "administrador.productos.productos")->middleware('can:admin.productos')->name("admin.productos");
Route::view("marcas", "administrador.productos.marcas")->middleware('can:admin.marcas')->name("admin.marcas");
Route::view("codigo_barra", "administrador.productos.codigo_barra")->middleware('can:admin.codigo_barra')->name("admin.codigo_barra");
Route::view("categorias", "administrador.productos.categorias")->middleware('can:"admin.categorias')->name("admin.categorias");
Route::view("unidades", "administrador.productos.unidades")->middleware('can:admin.unidades')->name("admin.unidades");
Route::get('search/{id}/buscar_productos', [AdminController::class, 'buscar_productos'])->middleware('can:search.buscar_productos')->name('search.buscar_productos');
Route::get('search/buscar_productos_compras',[AdminController::class,'buscar_productos_compra'])->middleware('can:search.buscar_productos_compra')->name('search.buscar_productos_compra');
Route::get('search/buscar_productos_compras2',[AdminController::class,'buscar_productos_compra2'])->middleware('can:search.buscar_productos_compra')->name('search.buscar_productos_compra2');

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
