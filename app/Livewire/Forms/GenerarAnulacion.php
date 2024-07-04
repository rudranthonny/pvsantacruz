<?php

namespace App\Livewire\Forms;

use App\Clases\SimpleXmlToArray;
use App\Models\Cfactura;
use App\Models\Cinvoice;
use App\Models\Configuracion;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;
use SoapClient;

class GenerarAnulacion extends Form
{
    use SimpleXmlToArray;

    #[Rule('required', as: 'Motivo de Anulación', onUpdate: false)]
    public $MotivoAnulacion;

    public function anular_factura(Invoice $invoice)
    {
        $this->validate();
        #generar recibo
        $cfactura  = Cfactura::find(1);
        $configuracion = Configuracion::find(1);
        $soapclient = new SoapClient($cfactura->anulacion);
        $param = array(
            'Cliente' => $configuracion->eco_cliente,
            'Usuario' => $configuracion->eco_usuario,
            'Clave' => $configuracion->clave,
            'Nitemisor' => $configuracion->nitemisor,
            'Numautorizacionuuid' => $invoice->auth,
            'Motivoanulacion' => $this->MotivoAnulacion,
        );
        $response = $soapclient->Execute($param);

        #registrar la respuesta o devolver en un alert cualquier error que se de
        return $this->registrarRpta($response->Respuesta, $invoice);
    }



    public function registrarRpta(string $stringXml, Invoice $invoice)
    {
        $arrayxml = $this->simplexml($stringXml);
        // $this->verifyErrorXml($arrayxml);
        $this->storefile(collect($arrayxml->get('children'))->get('pdf')[0]['text'], $invoice->number . '.pdf');
        $this->storefile(collect($arrayxml->get('children'))->get('xml')[0]['text'], $invoice->number . '.xml');
        $n_cinvoice = $this->getDataCinvoice(collect($arrayxml->get('children'))->get('xml')[0]['text'], $invoice);
        return $n_cinvoice;
    }

    public function simplexml($stringXml)
    {
        $simplexml = simplexml_load_string($stringXml);
        $arrayxml = $this->xmlObjToArr($simplexml);
        return collect($arrayxml);
    }

    public function verifyErrorXml($arrayxml)
    {
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
        Storage::put("public/ecofactura/anulacion/$nombreArchivo", base64_decode($base64Archivo));
        // Recuperar file
        //dd(Storage::get("ecofactura/$nombreArchivo"));
    }

    public function storeCinvoices($guestId, $fecha_anulacion, $fecha_certificacion, $pathXml, $pathPdf)
    {
        $n_cinvoice = Cinvoice::create([
            'guest_id' => $guestId,
            'fecha_anulacion' => $fecha_anulacion,
            'fecha_certificacion' => $fecha_certificacion,
            'xml' => $pathXml,
            'pdf' => $pathPdf,
        ]);

        return $n_cinvoice;
    }

    public function getDataCinvoice($stringXml, Invoice $invoice)
    {

        $xml = base64_decode($stringXml);
        $simplexmlRpta = simplexml_load_string($xml);
        $fecha_anulacion = substr((string)$simplexmlRpta->xpath('//dte:DatosGenerales')[0]['FechaEmisionDocumentoAnular'], 0, 10);
        $fecha_certificacion = substr((string)$simplexmlRpta->xpath('//dte:FechaHoraCertificacion')[0], 0, 10);
        $pathPdf = 'ecofactura/anulacion/' . $invoice->number . '.pdf';
        $pathXml = 'ecofactura/anulacion/' . $invoice->number . '.xml';

        $n_invoice = $this->storeCinvoices($invoice->guest_id, $fecha_anulacion, $fecha_certificacion, $pathXml, $pathPdf);
        return $n_invoice;
    }
}
