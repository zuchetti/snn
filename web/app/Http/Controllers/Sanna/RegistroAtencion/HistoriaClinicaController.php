<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class HistoriaClinicaController extends Controller
{
    //
    use conection;
      
    //getAntecendentesp
    public function getAntecendentesp(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_antecedente_pat';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getAntecendentesnp
    public function getAntecendentesnp(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_antecedente_nopat';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

      //getSeguroTopico
    public function getSeguroTopico(){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'idtopico'=>session('topico')->idtopico,
        'idprofesional'=>session('medico')->data[0]->info[0]->idprofesional];
        $url = $this->server2.'api/get_seguro_topico';
        
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        // exit(json_encode($result));
        return json_encode($result);
    }



    public function saveHistorySession(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';

        if(session('paciente')!=null){
            $date = str_replace("/", "-", session('paciente')->fec_nacimiento);
            $fecha_nacimiento=date('Y-m-d', strtotime($date));
            if(session('paciente')->tipo_atencion==0){
                $nro_poliza=session('paciente')->NumeroPoliza;
                $nro_autorizacion=session('paciente')->cod_cso.'-'.session('paciente')->CodigoAfiliado.'-'.session('paciente')->nro_autorizacion;
                $response_siteds=session('paciente')->response_siteds;
                $response_siteds->NumeroContrato = session('paciente')->NumeroContrato;
                $response_siteds->NumeroCertificado = session('paciente')->NumeroCertificado;
                $response_siteds->NumeroPoliza = session('paciente')->NumeroPoliza;
                $response_siteds->DesParentesco = session('paciente')->DesParentesco;
            }else{
                $nro_poliza=-1;
                $nro_autorizacion=-1;
                $response_siteds=array('status'=>100,'rspt'=>"not");
            }
            $codigo_afi = $request['codigo_afi'];
            if(empty($codigo_afi))$codigo_afi = "";
            $patologicos = $request['patologicos'];
            if(empty($patologicos))$patologicos = array();
            $no_patologico = $request['no_patologico'];
            if(empty($no_patologico))$no_patologico = array();
    
            $quirurgico = $request['quirurgico'];
            if(empty($quirurgico))$quirurgico = "";
    
            
            $padres = $request['padres'];
            if(empty($padres))$padres = "";
    
            $abuelos = $request['abuelos'];
            if(empty($abuelos))$abuelos = "";
    
            $hermanos = $request['hermanos'];
            if(empty($hermanos))$hermanos = "";
    
            $conyugue = $request['conyugue'];
            if(empty($conyugue))$conyugue = "";
    
            $persona_responsable = $request['persona_responsable'];
            if(empty($persona_responsable))$persona_responsable = "";
    
            $tlf_casa_paciente = $request['tlf_casa_paciente'];
            if(empty($tlf_casa_paciente))$tlf_casa_paciente = "";
    
            
            $celular_responsble = $request['celular_responsble'];
            if(empty($celular_responsble))$celular_responsble = "";
    
            $grupos_factorh = $request['grupos_factorh'];
            if(empty($grupos_factorh))$grupos_factorh = "";
    
            $alergias = $request['alergias'];
            if(empty($alergias))$alergias = "";
    
            $etnia = $request['etnia'];
            if(empty($etnia))$etnia = "";
            
            $idioma = $request['idioma'];
            if(empty($idioma))$idioma = "";
    
            $religion = $request['religion'];
            if(empty($religion))$religion = "";
    
            $gradoinstitucion = $request['gradoinstitucion'];
            if(empty($gradoinstitucion))$gradoinstitucion = "";
    
            $ocupacion = $request['ocupacion'];
            if(empty($ocupacion))$ocupacion = "";
    
            $procedencia = $request['procedencia'];
            if(empty($procedencia))$procedencia = "";
    
        
    
            $procedencia = $request['procedencia'];
            if(empty($procedencia))$procedencia = "";
    
            $correo = $request['correo'];
            if(empty($correo))$correo = "";
            
            
            
            $data=['so'=>2,'lat'=>$lat,
            'long'=>$long,'idtiposeguro'=>$request['idtiposeguro'],
            'idtopico'=>session('topico')->idtopico,'idsubcliente'=>session('paciente')->idsubcliente,
            'manejodatos'=>$request['autorizacion'],
            'idmodalidad'=>session('paciente')->idmodalidad,
            'fec_atencion'=>$request['fec_atencion'],'dni'=>session('paciente')->num_doc,'nombres'=>session('paciente')->nombres,'ape_paterno'=>session('paciente')->ape_paterno,
            'ape_materno'=>session('paciente')->ape_materno,'tipo_atencion'=>session('paciente')->tipo_atencion,'fec_nacimiento'=>$fecha_nacimiento,
            'sexo'=>session('paciente')->sexo,'nro_poliza'=>$nro_poliza,'nro_autorizacion'=>$nro_autorizacion,
            'response_siteds'=>$response_siteds,'domicilio'=>$request['domicilio'],'telf_2'=>"",
            'alergias'=>$alergias,'grupos_factorh'=>$grupos_factorh,'telf_1'=>$request['telf_1'],'idprofesional'=>session('medico')->data[0]->info[0]->idprofesional
            ,'hoja_filiacion'=>array(
            'NombreContratante'=>session('paciente')->NombreContratante,
            'codigo_afi'=>$codigo_afi,'etnia'=>$etnia,
            'idioma'=>$idioma,'religion'=>$religion,'email'=>$correo,
            'estadocivil'=>$request['estadocivil'],'gradoinstitucion'=>$gradoinstitucion,
            'ocupacion'=>$ocupacion,'procedencia'=>$procedencia,'no_patologico'=>$no_patologico,
            'patologicos'=>$patologicos,'quirurgico'=>$quirurgico,'padres'=>$padres,'abuelos'=>$abuelos,
            'hermanos'=>$hermanos,'conyugue'=>$conyugue,'persona_responsable'=>$persona_responsable,
            'celular_responsble'=>$celular_responsble,'tlf_casa_paciente'=>$tlf_casa_paciente)];
            $dataU = $object = json_decode(json_encode($data), FALSE);
            $request->session()->put(['filiacion'=>$dataU]);
            return 'ok'; 
        }else{
            return 'ERROR EN LA SESION DEL PACIENTE'; 
        }
       
    }


 

    //getHistoria
    public function getHistoria(Request $request){

        if(session('paciente')!=null){
            $lat='-12.0431800';
            $long='-77.0282400';
            $data=['so'=>2,'lat'=>$lat,'long'=>$long,'dni'=>session('paciente')->num_doc];
            $url = $this->server2.'api/get_ultimo_historial';
            $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
            return $result;
        }else{
            
            return '';
        }
      
    }

    //historyClinic
    public function historyClinic(Request $request){
        $info=$this->getHistoria($request);
        $antencedent_p=$this->getAntecendentesp($request);
        $antencedent_np=$this->getAntecendentesnp($request);
        $seguro=json_decode($this->getSeguroTopico());

        // exit(json_encode(session('filiacion')));
        return view('registroAtencion/historiaClinica',['info'=>$info,
        'antencedent_p'=>$antencedent_p,'antencedent_np'=>$antencedent_np,'seguro'=>$seguro]);
    }



}
