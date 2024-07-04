<?php

namespace App\Clases;

use App\Models\Cfactura;
use App\Models\Configuracion;
use Exception;
use SoapClient;

trait ConsultaDpiOrCui
{
    use SimpleXmlToArray;

    public function consultaDpiOrCui($tipo_documento = NULL,$numero)
    {
        try {
            $cfactura  = Cfactura::find(1);
            $configuracion = Configuracion::find(1);
            $soapclient = new SoapClient($cfactura->consultadpi);
            $param = array(
                'Cliente' => $configuracion->eco_cliente,
                'Usuario' => $configuracion->eco_usuario,
                'Clave' => $configuracion->clave,
                'Receptorid' => $tipo_documento.$numero,
            );

            $response = $soapclient->Execute($param);
            $simplexml = simplexml_load_string($response->Informacion);
            $arrayxml = $this->xmlObjToArr($simplexml);
            $arrayxml = collect($arrayxml);
            return $arrayxml;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
