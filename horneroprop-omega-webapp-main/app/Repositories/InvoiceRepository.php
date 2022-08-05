<?php

namespace App\Repositories;


use App\AfipInvoice;
use App\AfipCredential;
use App\Persona;
use App\Packages\PDFVoucher;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Afip;

class InvoiceRepository {


    private Afip $_client;

    private AfipCredential $_credential;

    private Persona $_person;

    private Bool $_production;

    private Int $_voucherType;

    private Array $_parsedData;

    public function __construct(Persona $person, $sourceData, AfipCredential $afipCredential) {

        $this->_person = $person;
        $this->_credential = $afipCredential;

        $this->_production = App::environment('production');
        $this->_voucherType = $this->_resolveVoucherType();

        // AFIP
        $this->_client = $this->_getClient();

        $this->_parsedData = $this->_parseInvoiceData($sourceData);
    }

    private function _getClient() : Afip {
        // Directorio para el TA
        Storage::makeDirectory('afip/' . Auth::user()->sucursal->id . '/credentials/' . $this->_credential->id . '/ta/');

        $credentialData = [
            'CUIT' => $this->_credential->responsable_number,
            'production' => $this->_production,
            'res_folder' => public_path('storage/'),
            'ta_folder' => public_path('storage/afip/' . Auth::user()->sucursal->id . '/credentials/' . $this->_credential->id . '/ta/'),
            'cert' => $this->_credential->crt,
            'key' => $this->_credential->key,
        ];

        return new Afip($credentialData);
    }

    private function _parseInvoiceData($data) {
        return [
            // Company data
            'credential_business_name' => $this->_credential->business_name,
            'credential_sales_point' => $this->_credential->sales_point,
            'credential_address' => $this->_credential->address,
            'credential_activity_started_at' => $this->_credential->activity_started_at,
            'credential_responsable_type' => $this->_credential->responsable_type->nombre,
            'credential_responsable_number' => $this->_credential->responsable_number,

            // Client Data
            'client_name' => $this->_person->getFullName(), // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'client_address' => $this->_person->address?? 'N/A', // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'client_document_type' => $this->_person->tipo_documento->afip_id, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'client_document_type_name' => $this->_person->tipo_documento->nombre, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'client_document_number' => $this->_person->nro_documento,  // Número de documento del comprador (0 consumidor final)
            'client_iva_type_name' => $this->_person->tipo_iva->nombre, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'client_iva_number' => $this->_person->nro_cui,  // Número de documento del comprador (0 consumidor final)

            // Invoice Data
            'invoice_type' => $this->_voucherType, // Tipo de comprobante (ver tipos disponibles)
            'invoice_register_amount' => 1,  // Cantidad de comprobantes a registrar
            'invoice_concept' => 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'invoice_service_date_from' => Carbon::create()->month($data->mes)->year($data->ano)->startOfMonth()->format('Ymd'), // Inicio Periodo facturado
            'invoice_service_date_to' => Carbon::create()->month($data->mes)->year($data->ano)->endOfMonth()->format('Ymd'), // Fin Periodo
            'invoice_pay_expiration' => Carbon::now()->format('Ymd'), // Vencimiento para pago
            'invoice_number_from' => $lastInvoice = $this->_client->ElectronicBilling->GetLastVoucher($this->_credential->sales_point, $this->_voucherType) + 1,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'invoice_number_to' => $lastInvoice,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'invoice_date' => Carbon::now()->format('Ymd'), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'invoice_amount' => $data->honorarios, // Importe total del comprobante
            'invoice_currency_type' => 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'invoice_currency_id' => 1,     // Cotización de la moneda usada (1 para pesos argentinos)
            'invoice_iva' => array( // (Opcional) Alícuotas asociadas al comprobante
                array(
                    'Id' => 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
                    'BaseImp' => 100, // Base imponible
                    'Importe' => 21 // Importe
                )
            ),
        ];
    }

    private function _resolveVoucherType() : Int {
        switch($this->_credential->responsable_type->id){
            // Responsable Inscripto
            case 1:
                switch($this->_person->tipo_iva->id){
                    case 1:
                        return 1; //Factura A
                    case 2:
                        return 6; //Factura B
                    default:
                        return 11; //Factura C
                }
            // Monotributo
            case 2:
                return 11; //Factura C
            default:
                return 11; //Factura C
        }
    }

    public function generateAfipInvoice() {
        switch($this->_voucherType) {
            case 1:
                return $this->generateAfipInvoiceTypeA();
            case 6:
                return $this->generateAfipInvoiceTypeB();
            case 11:
                return $this->generateAfipInvoiceTypeC();
        }
    }

    public function generateAfipInvoiceTypeB() {
        $invoiceData = array(
            'CantReg' 	=> $this->_parsedData['invoice_register_amount'],
            'PtoVta' 	=> $this->_parsedData['credential_sales_point'],
            'CbteTipo' 	=> $this->_parsedData['invoice_type'],
            'Concepto' 	=> $this->_parsedData['invoice_concept'],
            'FchServDesde' 	=> $this->_parsedData['invoice_service_date_from'],
            'FchServHasta' 	=> $this->_parsedData['invoice_service_date_to'],
            'FchVtoPago' 	=> $this->_parsedData['invoice_pay_expiration'],
            'DocTipo' 	=> $this->_parsedData['client_document_type'],
            'DocNro' 	=> $this->_parsedData['client_document_number'],
            'CbteDesde' => $this->_parsedData['invoice_number_from'],
            'CbteHasta' => $this->_parsedData['invoice_number_to'],
            'CbteFch' 	=> $this->_parsedData['invoice_date'],
            'ImpTotal' 	=> $this->_parsedData['invoice_amount'],
            'ImpTotConc'=> 0,
            'ImpNeto' 	=> $this->_parsedData['invoice_amount'],
            'ImpOpEx' 	=> 0,
            'ImpIVA' 	=> 0,
            'ImpTrib' 	=> 0,
            'MonId' 	=> 'PES',
            'MonCotiz' 	=> $this->_parsedData['invoice_currency_id'],
            'Iva' 		=> array(
                array(
                    'Id' 		=> 3,
                    'BaseImp' 	=> $this->_parsedData['invoice_amount'],
                    'Importe' 	=> 0,
                )
            ),

        );
        return $this->_client->ElectronicBilling->CreateVoucher($invoiceData);
    }

    public function generateAfipInvoiceTypeA() {
        $invoiceData = array(
            'CantReg' 	=> $this->_parsedData['invoice_register_amount'],
            'PtoVta' 	=> $this->_parsedData['credential_sales_point'],
            'CbteTipo' 	=> $this->_parsedData['invoice_type'],
            'Concepto' 	=> $this->_parsedData['invoice_concept'],
            'FchServDesde' 	=> $this->_parsedData['invoice_service_date_from'],
            'FchServHasta' 	=> $this->_parsedData['invoice_service_date_to'],
            'FchVtoPago' 	=> $this->_parsedData['invoice_pay_expiration'],
            'DocTipo' 	=> $this->_parsedData['client_document_type'],
            'DocNro' 	=> $this->_parsedData['client_document_number'],
            'CbteDesde' => $this->_parsedData['invoice_number_from'],
            'CbteHasta' => $this->_parsedData['invoice_number_to'],
            'CbteFch' 	=> $this->_parsedData['invoice_date'],
            'ImpTotal' 	=> $this->_parsedData['invoice_amount'],
            'ImpTotConc'=> 0,
            'ImpNeto' 	=> $this->_parsedData['invoice_amount'],
            'ImpOpEx' 	=> 0,
            'ImpIVA' 	=> 0,
            'ImpTrib' 	=> 0,
            'MonId' 	=> 'PES',
            'MonCotiz' 	=> $this->_parsedData['invoice_currency_id'],
            'Iva' 		=> array(
                array(
                    'Id' 		=> 3,
                    'BaseImp' 	=> $this->_parsedData['invoice_amount'],
                    'Importe' 	=> 0,
                )
            ),

        );
        return $this->_client->ElectronicBilling->CreateVoucher($invoiceData);
    }

    public function generateAfipInvoiceTypeC() {
        $invoiceData = array(
            'CantReg' 	=> $this->_parsedData['invoice_register_amount'],
            'PtoVta' 	=> $this->_parsedData['credential_sales_point'],
            'CbteTipo' 	=> $this->_parsedData['invoice_type'],
            'Concepto' 	=> $this->_parsedData['invoice_concept'],
            'FchServDesde' 	=> $this->_parsedData['invoice_service_date_from'],
            'FchServHasta' 	=> $this->_parsedData['invoice_service_date_to'],
            'FchVtoPago' 	=> $this->_parsedData['invoice_pay_expiration'],
            'DocTipo' 	=> $this->_parsedData['client_document_type'],
            'DocNro' 	=> $this->_parsedData['client_document_number'],
            'CbteDesde' => $this->_parsedData['invoice_number_from'],
            'CbteHasta' => $this->_parsedData['invoice_number_to'],
            'CbteFch' 	=> $this->_parsedData['invoice_date'],
            'ImpTotal' 	=> $this->_parsedData['invoice_amount'],
            'ImpTotConc'=> 0,
            'ImpNeto' 	=> $this->_parsedData['invoice_amount'],
            'ImpOpEx' 	=> 0,
            'ImpIVA' 	=> 0,
            'ImpTrib' 	=> 0,
            'MonId' 	=> 'PES',
            'MonCotiz' 	=> $this->_parsedData['invoice_currency_id'],

        );
        return $this->_client->ElectronicBilling->CreateVoucher($invoiceData);
    }

    public function generateAfipInvoicePDF(Array $cae) {

        switch($this->_voucherType) {
            case 1:
                $invoiceType = 'A';
            case 6:
                $invoiceType = 'B';
            default:
                $invoiceType = 'C';
        }

        $voucher = [
            'letra' => $invoiceType,
            'numeroComprobante' => $this->_parsedData['invoice_number_from'],
            'numeroPuntoVenta' => $this->_parsedData['credential_sales_point'],
            'cotizacionMoneda' => 1,
            'codigoMoneda' => 1,
            'CondicionVenta' => '',
            'cae' => $cae['CAE'],
            'fechaVencimientoCAE' => $cae['CAEFchVto'],
            'fechaComprobante' => $this->_parsedData['invoice_date'],
            'TipoComprobante' => 'FACTURA',
            'TipoDocumento' =>  $this->_parsedData['client_document_type_name'],
            'numeroDocumento' =>  $this->_parsedData['client_document_number'],
            'tipoResponsable' =>  $this->_parsedData['client_iva_type_name'],
            'codigoConcepto' => 80,
            'codigoTipoComprobante' => 1,
            'nombreCliente' => $this->_parsedData['client_name'],
            'domicilioCliente' => $this->_parsedData['client_address'],
            'importeTotal' => $this->_parsedData['invoice_amount'],
            'importeOtrosTributos' => '',
        ];

        $item = [
            'codigo' => 0,
            'cantidad' => 1,
            'UnidadMedida' => '',
            'descripcion' => 'Honorarios por administración de contrato de locación',
            'precioUnitario' => $this->_parsedData['invoice_amount'],
            'porcBonif' => 0,
            'impBonif' => 0,
            'Alic' => '',
            'importeItem' => 0,
        ];

        $voucher['items'][]=$item;

        $config = [
            'TRADE_SOCIAL_REASON' => $this->_parsedData['credential_business_name'],
            'VOUCHER_OBSERVATION' => '',
            'TRADE_CUIT' => $this->_parsedData['credential_responsable_number'],
            'TRADE_ADDRESS' => $this->_parsedData['credential_address'],
            'TRADE_TAX_CONDITION' => $this->_parsedData['credential_responsable_type'],
            'TRADE_INIT_ACTIVITY' => $this->_parsedData['credential_activity_started_at'],
        ];

        $htmlPDF = new PDFVoucher($voucher, $config);

        $html = $htmlPDF->emitirPDF();

        return PDF::loadHTML($html);
    }
}