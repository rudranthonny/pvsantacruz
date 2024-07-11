<?php

namespace App\Livewire\Forms;

use App\Clases\SimpleXmlToArray;
use App\Models\Cashbox;
use App\Models\Cfactura;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Guest;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Tracking;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Form;
use SoapClient;

class GenerarFactura extends Form
{
    use SimpleXmlToArray;

    public ?Cliente $cliente;
    public $TrnEstNum = 1;
    public $TipTrnCod = 'FACT';
    public $TrnNum;
    public $TrnFec;
    public $MonCod = 'GTQ';
    #[Rule('required', as: 'Identificación', onUpdate: false)]
    public $TrnBenConNIT;
    public $TrnExp = 0;
    public $TrnExento = 0;
    public $TrnFraseTipo = 0;
    public $TrnEscCod = 0;
    public $TrnEFACECliCod = null;
    #[Rule('required', as: 'Cliente Nombre', onUpdate: false)]
    public $TrnEFACECliNom;
    public $TrnEFACECliDir;
    public $TrnObs;
    public $TrnEmail;
    public $cliente_id;
    public $bienes_servicios = [];
    #[Rule('required', as: 'Tipo de Documento', onUpdate: false)]
    public $tipo_documento;

    public function validar_datos(){$this->validate();}

    public function obtener_correlativo()
    {
        $configuracion = Configuracion::find(1);
        $cfactura  = Cfactura::find(1);
        $soapclient = new SoapClient($cfactura->consultafac);
        $xmls ='<?xml version="1.0" encoding="UTF-8"?><Correlativo><NitEmisor>54097193</NitEmisor><Establecimiento>1</Establecimiento><TipoDocumento>FACT</TipoDocumento></Correlativo>';
        $param = array(
            'Cliente' => $configuracion->eco_cliente,
            'Usuario' => $configuracion->eco_usuario,
            'Clave' => $configuracion->clave,
            'Consulta' => $xmls,
        );

        $response = $soapclient->execute($param);
        $simplexml = simplexml_load_string($response->Respuesta);
        $arrayxml = $this->xmlObjToArr($simplexml);
        $arrayxml = collect($arrayxml);
        return $arrayxml['children']['ultimatransaccion'][0]['text'];
    }

    public function crear_factura()
    {
        $this->validate();
        $configuracion = Configuracion::find(1);
        $cfactura  = Cfactura::find(1);
        $this->TrnFec = date('Y-m-d');
        $this->TrnNum = $this->obtener_correlativo() + 1;
        $string = $this->generar_string();

        #generar recibo
        $soapclient = new SoapClient($cfactura->facturacion);
        $param = array(
            'Cliente' => $configuracion->eco_cliente,
            'Usuario' => $configuracion->eco_usuario,
            'Clave' => $configuracion->clave,
            'Nitemisor' => $configuracion->nitemisor,
            'Xmldoc' => $string,
        );
        $response = $soapclient->Execute($param);
        #registrar la respuesta o devolver en un alert cualquier error que se de
        $n_invocie = $this->registrarRpta($response->Respuesta);
        return $n_invocie;
    }

    public function generar_string()
    {
        if ($this->tipo_documento == 'NIT')
        {
            $identificador = '<TrnBenConNIT>' . $this->TrnBenConNIT . '</TrnBenConNIT>';
        } elseif ($this->tipo_documento == 'DPI') {
            $identificador = '<TrnBenConNIT>' . $this->TrnBenConNIT . '</TrnBenConNIT><TrnBenConEspecial>2</TrnBenConEspecial>';
        } elseif ($this->tipo_documento == 'EXT') {
            $identificador = '<TrnBenConEXT>' . $this->TrnBenConNIT . '</TrnBenConEXT>';
        } elseif ($this->tipo_documento == 'CF') {
            $identificador = '<TrnBenConNIT>CF</TrnBenConNIT>';
        }

        $apertura = '<stdTWS xmlns="FEL">';
        $datos_recibo =
            '
            <TrnEstNum>' . $this->TrnEstNum . '</TrnEstNum>
            <TipTrnCod>' . $this->TipTrnCod . '</TipTrnCod>
            <TrnNum>' . $this->TrnNum . '</TrnNum>
            <TrnFec>' . $this->TrnFec . '</TrnFec>
            <MonCod>' . $this->MonCod . '</MonCod>
            ' . $identificador . '
            <TrnExp>' . $this->TrnExp . '</TrnExp>
            <TrnExento>' . $this->TrnExento . '</TrnExento>
            <TrnFraseTipo>' . $this->TrnFraseTipo . '</TrnFraseTipo>
            <TrnEscCod>' . $this->TrnEscCod . '</TrnEscCod>
            <TrnEFACECliCod></TrnEFACECliCod>
            <TrnEFACECliNom>' . $this->TrnEFACECliNom . '</TrnEFACECliNom>
            <TrnEFACECliDir>' . $this->TrnEFACECliDir . '</TrnEFACECliDir>
            <TrnObs>' . $this->TrnObs . '</TrnObs>
            <TrnEmail>' . $this->TrnEmail . '</TrnEmail>';
        $detalle_apertura = '
            <stdTWSD>';
        $detalles = '';
        foreach ($this->bienes_servicios as $key => $bieser) {
            $cuerpo =
                '
                                <stdTWS.stdTWSCIt.stdTWSDIt>
                                <TrnLiNum>' . ($key + 1) . '</TrnLiNum>
                                <TrnArtCod></TrnArtCod>
                                <TrnArtNom>' . ($this->bienes_servicios[$key]['TrnArtNom']) . '</TrnArtNom>
                                <TrnCan>' . $this->bienes_servicios[$key]['TrnCan'] . '</TrnCan>
                                <TrnVUn>' . $this->bienes_servicios[$key]['TrnVUn'] . '</TrnVUn>
                                <TrnUniMed>UNI</TrnUniMed>
                                <TrnVDes>'. $this->bienes_servicios[$key]['TrnVDes'] .'</TrnVDes>
                                <TrnArtBienSer>' . $this->bienes_servicios[$key]['TrnArtBienSer'] . '</TrnArtBienSer>
                                <TrnArtImpAdiCod>' . $this->bienes_servicios[$key]['TrnArtImpAdiCod'] . '</TrnArtImpAdiCod>
                                <TrnArtImpAdiUniGrav>' . $this->bienes_servicios[$key]['TrnArtImpAdiUniGrav'] . '</TrnArtImpAdiUniGrav>
                                </stdTWS.stdTWSCIt.stdTWSDIt>
                            ';
            $detalles = $detalles . $cuerpo;
        }
        $detalle_cierre = '</stdTWSD>';
        $cierre = '</stdTWS>';
        $string = $apertura . $datos_recibo . $detalle_apertura . $detalles . $detalle_cierre . $cierre;
        return $string;
    }

    public function registrarRpta(string $stringXml)
    {
        $arrayxml = $this->simplexml($stringXml);
        $this->verifyErrorXml($arrayxml);
        $this->storefile(collect($arrayxml->get('children'))->get('pdf')[0]['text'], $this->TrnNum . '.pdf');
        $this->storefile(collect($arrayxml->get('children'))->get('xml')[0]['text'], $this->TrnNum . '.xml');
        $n_invoice = $this->getDataInvoice(collect($arrayxml->get('children'))->get('xml')[0]['text']);
        return $n_invoice;
    }

    public function registrarRptaRest(string $stringXml)
    {
        $arrayxml = $this->simplexml($stringXml);
        $this->verifyErrorXml($arrayxml);
        $this->storefile(collect($arrayxml->get('children'))->get('pdf')[0]['text'], $this->TrnNum . '.pdf');
        $this->storefile(collect($arrayxml->get('children'))->get('xml')[0]['text'], $this->TrnNum . '.xml');
        $n_invoice = $this->getDataInvoice(collect($arrayxml->get('children'))->get('xml')[0]['text']);
        return $n_invoice;
    }

    public function simplexml($stringXml)
    {
        $simplexml = simplexml_load_string($stringXml);
        $arrayxml = $this->xmlObjToArr($simplexml);
        return collect($arrayxml);
    }

    public function verifyErrorXml($arrayxml)
    {
        // $this->resetValidation(['error']);
        $this->reset(['error']);
        if (collect($arrayxml->get('children'))->has('error')) {

            $errors = collect($arrayxml->get('children'))->get('error')[0];

            $validated = Validator::make(
                ['error' => null],
                ['error' => 'required'],
                ['required' => $errors['name'] . ': ' . $errors['text']],
            )->validate();
        }
    }

    public function storefile($base64Archivo, $nombreArchivo)
    {
        Storage::put("public/ecofactura/$nombreArchivo", base64_decode($base64Archivo));
        // Recuperar file
        //dd(Storage::get("ecofactura/$nombreArchivo"));
    }

    public function storeInvoices($cliente_id, $auth, $issue_date, $certification_date, $serie, $number, $pathPdf)
    {
        $n_invoice = Invoice::create([
            'cliente_id' => $cliente_id,
            'auth' => $auth,
            'issue_date' => $issue_date,
            'certification_date' => $certification_date,
            'serie' => $serie,
            'number' => $number,
            'pdf' => $pathPdf,
        ]);

        return $n_invoice;
    }

    public function getDataInvoice($stringXml)
    {
        $xml = base64_decode($stringXml);
        $simplexmlRpta = simplexml_load_string($xml);

        $numeroAutorizacion = (string)$simplexmlRpta->xpath('//dte:NumeroAutorizacion')[0];
        $fechaHoraEmision = substr((string)$simplexmlRpta->xpath('//dte:DatosGenerales')[0]['FechaHoraEmision'], 0, 10);
        $fechaHoraCertificacion = substr((string)$simplexmlRpta->xpath('//dte:FechaHoraCertificacion')[0], 0, 10);
        $numeroSerie = (string)$simplexmlRpta->xpath('//dte:NumeroAutorizacion')[0]['Serie'];
        $numero = (string)$simplexmlRpta->xpath('//dte:NumeroAutorizacion')[0]['Numero'];
        $pathPdf = 'ecofactura/' . $this->TrnNum . '.pdf';

        $n_invoice = $this->storeInvoices($this->cliente_id, $numeroAutorizacion, $fechaHoraEmision, $fechaHoraCertificacion, $numeroSerie, $numero, $pathPdf);
        if (isset($n_invoice->id)) {
            return $n_invoice->id;
        }
        else {
            return null;
        }

    }
}
