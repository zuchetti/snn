<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class RegistroAtencionController extends Controller
{
    //
    use conection;

    protected $SitedsController;
    public function __construct(SitedsController $SitedsController)
    {
       $this->SitedsController = $SitedsController;

    }
  

    //getSubclienteTopico
    public function getSubclienteTopico(){

        if(session('topico')!=null){
            $lat='-12.0431800';
            $long='-77.0282400';
            $data=['idtopico'=>session('topico')->idtopico,
            'so'=>2,'lat'=>$lat,'long'=>$long];
            $url = $this->server2.'api/get_subcliente_topico';
            $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        }else{
            $result = ['status'=>100,'message'=>"Error falta el topico "];

        }
       
        return json_encode($result);
    }


        
    //getcodigoIAFA
    public function getcodigoIAFA(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_codigoIAFA';
        $result = $this->getJson($url,json_encode($data));
        return json_encode($result);
    }



    //newAtencion
    public function newAtencion(Request $request){
        $request->session()->forget('paciente');
        $request->session()->forget('tableMedicament');
        $request->session()->forget('filiacion');
        $request->session()->forget('diagnostico');
        $request->session()->forget('receta');
        $request->session()->forget('descanso');
        $request->session()->forget('examenes');
        $request->session()->forget('finalizar');
    
        $aseguradoras = json_decode($this->getcodigoIAFA($request));
        
        return view('registroAtencion/nueva',['aseguradoras'=>$aseguradoras]);
    }

    //infoGeneral
    public function infoGeneral(Request $request){
        $info= json_decode($this->SitedsController->getPaciente($request,$request['iafas'],$request['ape_paterno'],$request['ape_materno'],$request['nombres'],$request['tipo_doc'],$request['num_doc']));
        
        // exit(json_encode($info));
        
        if($info){
            if($info->status==200){

                $arrayInfo = [];
                foreach($info->data as $a){
                    if($a->NumeroPlan==$request['NumeroPlan'] && $a->CodEstado==$request['CodEstado']){
                        $arrayInfo[]=$a;
                    }
                }

                
    

                if(count($arrayInfo)>0){
                    $fechanacimiento=date("d-m-y", strtotime($arrayInfo[0]->FechaNacimiento));
                    $subcliente=json_decode($this->getSubclienteTopico());
                    
                    //exit(json_encode($subcliente));

                    if($subcliente->status==200){
                        $iafas=$request['iafas'];
                      
                        $detalle = json_decode($this->SitedsController->getDetailPaciente($request['codafiliado'],$iafas,$arrayInfo[0]->CodProducto,$arrayInfo[0]->DesProducto, 
                        $arrayInfo[0]->ApellidoPaternoAfiliado,$arrayInfo[0]->ApellidoMaternoAfiliado,$arrayInfo[0]->NombresAfiliado,$arrayInfo[0]->CodParentesco,
                        $arrayInfo[0]->NombreContratante,$arrayInfo[0]->CodigoAfiliado,$arrayInfo[0]->CodTipoDocumentoAfiliado,$arrayInfo[0]->NumeroDocumentoAfiliado,
                        $arrayInfo[0]->NumeroPlan,$arrayInfo[0]->NumeroDocumentoContratante,$arrayInfo[0]->TipoCalificadorContratante,$arrayInfo[0]->CodTipoDocumentoContratante));
                        if($detalle){
                            if($detalle->status==200){
                                if($detalle->data->DatosAfiliado->NumeroPoliza==""){
                                    $num_poliza=1;
                                }else{
                                    $num_poliza=$detalle->data->DatosAfiliado->NumeroPoliza;
                                }
    
                                $infoPaciente = ['cod_cso'=>session('topico')->cod_cso,
                                'ape_paterno'=>$detalle->data->DatosAfiliado->ApellidoPaternoAfiliado,
                                'ape_materno'=>$detalle->data->DatosAfiliado->ApellidoMaternoAfiliado,
                                'nombres'=>$info->data[0]->NombresAfiliado,'sexo'=>$detalle->data->DatosAfiliado->CodGenero,
                                'fec_nacimiento'=>$detalle->data->DatosAfiliado->FechaNacimiento,
                                'edad'=>$detalle->data->DatosAfiliado->Edad,'tipo_atencion'=>0,
                                'NumeroPoliza'=>$num_poliza,
                                'FechaInicioVigencia'=>$detalle->data->DatosAfiliado->FechaInicioVigencia,
                                'DesParentesco'=>$detalle->data->DatosAfiliado->DesParentesco,
                                'NumeroContrato'=>$detalle->data->DatosAfiliado->NumeroContrato,
                                'NumeroCertificado'=>$detalle->data->DatosAfiliado->NumeroCertificado,
                                'tipo_doc'=>$detalle->data->DatosAfiliado->CodTipoDocumentoAfiliado,
                                'num_doc'=>$detalle->data->DatosAfiliado->NumeroDocumentoAfiliado,
                                'iafas'=>$iafas,
                                'CodigoAfiliado'=>$arrayInfo[0]->CodigoAfiliado,
                                'NombreContratante'=>$detalle->data->DatosAfiliado->NombreContratante];
                                $dataU = $object = json_decode(json_encode($infoPaciente), FALSE);
                                $request->session()->put(['paciente'=>$dataU]);
                        
                                    if($arrayInfo[0]->CodEstado==1 or $arrayInfo[0]->CodEstado==6){    
                                        //print_r(json_encode($subcliente));   
                                        return view('registroAtencion/infoGeneral',['detalle'=>$detalle,'subcliente'=>$subcliente,
                                        'CodProducto'=>$arrayInfo[0]->CodProducto,'CodEstado'=>$arrayInfo[0]->CodEstado,
                                        'iafas'=>$request['iafas'],'message'=>'200']);
                                    }else{
                                        //print_r($subcliente);
                                        return view('registroAtencion/PacienteCortesia_iafas',['subcliente'=>$subcliente]);
                                    } 
                                }else{
                                    return view('registroAtencion/infoGeneral',['message'=>'ERROR EN EL SERVICIO 5']);
                    
                                }
                            }else{
                                return view('registroAtencion/infoGeneral',['message'=>'ERROR EN EL SERVICIO 4']);
    
                            }
                        }else{
                            return view('registroAtencion/infoGeneral',['message'=>'Error en la respuesta del siteds']);
  
                        }
                       
        
                    
                    
                    }else{
                        
                        return view('registroAtencion/infoGeneral',['message'=>'ERROR EN EL SERVICIO 3']);
            
                        
                    }
        
                
            }else{
    
                return view('registroAtencion/infoGeneral',['message'=>'ERROR EN EL SERVICIO 2']);
    
            }  
           
        }else{
            return view('registroAtencion/infoGeneral',['message'=>'Error al obtener datos del paciente']);


        }



        
    }


    
    public function PacienteCortesia(Request $request){
        $subcliente=json_decode($this->getSubclienteTopico());
        return view('registroAtencion/PacienteCortesia',['subcliente'=>$subcliente]);

    }
  
  
    public function PacienteCortesiaIafas(Request $request)
    {
        $subcliente=json_decode($this->getSubclienteTopico());
        return view('registroAtencion/PacienteCortesia_iafas',['subcliente'=>$subcliente]);

    }
  
    
    function edad($fecha){
        $dias = explode("-", $fecha, 3);
        $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
        $edad = (int)((time()-$dias)/31556926 );
        return $edad;
    }

    public function sendFirma(Request $request){
        
        $name =  $this->guardarArchivoBase64($request['base64']);
        $image = ["filename"=>$name,"base64"=>$request['base64']];
        $request->session()->put(['firma'=>$image]);
        return json_encode(session('firma'));
        
    }

    function guardarArchivoBase64($base64) {
        // Extraer la extensión del Base64
        if (preg_match('/^data:image\/(\w+);base64,/', $base64, $matches)) {
            $extension = $matches[1]; // Obtener la extensión (ejemplo: png, jpg)
            $base64 = substr($base64, strpos($base64, ',') + 1); // Eliminar el encabezado
            $base64 = base64_decode($base64); // Decodificar el contenido
        } else {
            return 'Formato Base64 inválido.';
        }
        // Generar un nombre de archivo aleatorio
        $nombreArchivo = $this->generarNombreUnico(32) . '.' . $extension;
        return $nombreArchivo; // Retornar el nombre del archivo generado
    }
    
    // Función para generar un nombre aleatorio único
    function generarNombreUnico($longitud = 32) {
        return substr(bin2hex(random_bytes(ceil($longitud / 2))), 0, $longitud);
    }

    //savedPacienteCortesia
    public function savedPacienteCortesia(Request $request){

        $fechanacimiento=date("d-m-Y", strtotime($request['fec_nacimiento']));
        $edad =$this->edad($fechanacimiento);
        $infoPaciente = ['idsubcliente'=>$request['idsubcliente'],'idmodalidad'=>$request['idmodalidad'],
        'tipo_doc'=>$request['tipo_doc'],'num_doc'=>$request['num_doc'],'ape_paterno'=>$request['ape_paterno'],'ape_materno'=>$request['ape_materno'],
        'nombres'=>$request['nombres'],'fec_nacimiento'=>$request['fec_nacimiento'],'tipo_atencion'=>1,
        'sexo'=>$request['sexo'],'edad'=>$edad,'NombreContratante'=>"-1",'iafas'=>""];
        $dataU = $object = json_decode(json_encode($infoPaciente), FALSE);
        $request->session()->put(['paciente'=>$dataU]);
        
        //print_r(session('paciente'));
        return 'ok';
    }


    //ConsultaNumeroAutorizacion
    public function ConsultaNumeroAutorizacion(Request $request){
        $url = $this->server2.'api/get_codigo_autorizacion_siteds';
        
        $result = $this->getServices($url,json_encode($request['objData']),session('medico')->data[0]->token);
        //print_r(json_encode($result));
        if($result){
            if($result->status==200){
                if($result->data->NumeroAutorizacion!=""){
                    $nro_autorizacion=$result->data->NumeroAutorizacion;
                    $paciente=session('paciente');
                    $response_siteds=$result->data;
                    $paciente->nro_autorizacion=$nro_autorizacion;
                    $paciente->response_siteds=$response_siteds;
                    $paciente->idsubcliente=$request['idsubcliente'];
                    $paciente->idmodalidad=$request['idmodalidad'];
                    session(['paciente' => $paciente]);
                    $request->session()->put(['modalidad'=>$request['idmodalidad']]);
                    return json_encode($result);
    
                }else{
    
                    return json_encode(['status'=>100,'message'=>"Error sin NumeroAutorizacion "]);
    
                }
               
    
            }else{
                return json_encode(['status'=>100,'message'=>"Error en el servicio "]);
    
            }
        }else{
            return json_encode(['status'=>100,'message'=>"Error en el servicio "]);

        }
        
    }

}
