<?php

namespace Database\Seeders;

use App\Models\Cfactura;
use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_cfactura = new Cfactura();
        $n_cfactura->consultadpi = 'http://pruebas.ecofactura.com.gt:8080/fel/areceptorinfo?wsdl';
        $n_cfactura->facturacion = 'https://www.facturaenlineagt.com/adocumento?wsdl';
        $n_cfactura->anulacion = 'https://www.facturaenlineagt.com/aanulacion?wsdl';
        $n_cfactura->consultafac = 'https://www.facturaenlineagt.com/acorrelativo?wsdl';
        $n_cfactura->correlativo = 0;
        $n_cfactura->save();

        $configuracion = Configuracion::find(1);
        $configuracion->eco_cliente = "54097193";
        $configuracion->eco_usuario = "ADMIN";
        $configuracion->clave = "Ferreteria#123.";
        $configuracion->Nitemisor = "54097193";
        $configuracion->save();
    }
}
