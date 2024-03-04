<?php
use Illuminate\Support\Facades\Route;

Route::view('', 'administrador.index')->name('admin.index');
Route::view('configuracion/ajustes_sistema', 'administrador.configuracion.ajustesistema')->name('admin.configuracion.ajustesistema');
Route::view("moneda","administrador.ajustes.moneda")->name("moneda");
Route::view("almacen","administrador.ajustes.almacen")->name("admin.almacen");
Route::view("marcas","administrador.ajustes.marcas")->name("admin.marcas");
