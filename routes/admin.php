<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::view('', 'administrador.index')->name('admin.index');
Route::view('configuracion/ajustes_sistema', 'administrador.configuracion.ajustesistema')->name('admin.configuracion.ajustesistema');
Route::view("moneda","administrador.ajustes.moneda")->name("moneda");
Route::view("almacen","administrador.ajustes.almacen")->name("admin.almacen");
#productos
Route::view("productos","administrador.productos.productos")->name("admin.productos");
Route::view("marcas","administrador.productos.marcas")->name("admin.marcas");
Route::view("codigo_barra","administrador.productos.codigo_barra")->name("admin.codigo_barra");
Route::get('search/{id}/buscar_productos',[AdminController::class,'buscar_productos'])->name('search.buscar_productos');
