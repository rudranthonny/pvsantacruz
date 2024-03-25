<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Producto;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ImprimirCodigo extends Component
{
    public $search = '';
    public $salmacen;
    public $iteration;
    public $buscar_producto_oculto;
    public $stipo_papel;
    public $barcode,$barcode_style;
    public $lista_productos = [];

    public function updatedStipoPapel(){
        if ($this->stipo_papel == 1) {
            $this->barcode = 'barcodea4';
            $this->barcode_style = 'barcode-item style40';
        }
        elseif ($this->stipo_papel == 2) {
            $this->barcode = 'barcode_non_a4';
            $this->barcode_style = 'barcode-item style30';
        }
        elseif ($this->stipo_papel == 3) {
            $this->barcode = 'barcodea4';
            $this->barcode_style = 'barcode-item style24';
        }
        elseif ($this->stipo_papel == 4) {
            $this->barcode = 'barcode_non_a4';
            $this->barcode_style = 'barcode-item style20';
        }
        elseif ($this->stipo_papel == 5) {
            $this->barcode = 'barcodea4';
            $this->barcode_style = 'barcode-item style18';
        }
        elseif ($this->stipo_papel == 6) {
            $this->barcode = 'barcode_non_a4';
            $this->barcode_style = 'barcode-item style14';
        }
        elseif ($this->stipo_papel == 7) {
            $this->barcode = 'barcodea4';
            $this->barcode_style = 'barcode-item style12';
        }
        elseif ($this->stipo_papel == 8) {
            $this->barcode = 'barcode_non_a4';
            $this->barcode_style = 'barcode-item style10';
        }
        else {
            $this->stipo_papel = "";
        }
    }

    public function updatedSearch(){
        $this->iteration++;
        $valmacen = Almacen::find($this->salmacen);
        if ($valmacen)
        {
            $this->dispatch('activar_buscador_producto');
        }
        else {$this->dispatch('advertencia_almacen'); }
    }

    public function reiniciar_lista_productos(){
        $this->reset('lista_productos');
    }

    public function updatedBuscarProductoOculto()
    {
        $bproducto = Producto::where('codigo',$this->buscar_producto_oculto)->first();
        if ($bproducto){
            $this->lista_productos[$bproducto->codigo]['nombre'] = $bproducto->designacion;
            $this->lista_productos[$bproducto->codigo]['precio'] = $bproducto->precio;
            $this->lista_productos[$bproducto->codigo]['simbologia'] = $bproducto->simbologia;
            $this->lista_productos[$bproducto->codigo]['cantidad'] = 1;
        }
    }

    public function descargar_codigo_barrar_imprimir(){
        $barcode = $this->barcode;
        $barcode_style = $this->barcode_style;

        if (count($this->lista_productos) > 0) {
        $nombre_archivo ='Lista_productos-'.date("F j, Y, g:i a").'.pdf';
        $lista_productos = $this->lista_productos;
        $consultapdf = FacadePdf::loadView('administrador.productos.codigo_barras_pdf', compact('lista_productos','barcode','barcode_style'))->setPaper('a4');
        $pdfContent = $consultapdf->output();
            return response()->streamDownload(
                fn () => print($pdfContent),
                $nombre_archivo
            );
        }
    }

    public function render()
    {
        $almacenes = Almacen::all();
        return view('livewire.imprimir-codigo',compact('almacenes'));
    }
}
