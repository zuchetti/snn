<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class DiagnosticoController extends Controller
{
    use conection;

    protected $HistoriaClinicaController;
    public function __construct(HistoriaClinicaController $HistoriaClinicaController)
    {
       $this->HistoriaClinicaController = $HistoriaClinicaController;
    }

    //getDiagnosticos
    public function getDiagnosticos(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/get_diagnosticos';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }
  




    public function saveDiagnosticSession(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $paciente=session('paciente');

        if(session('paciente')!=null){
            $paciente->cie10=$request['cie10'];
            session(['paciente' => $paciente]);
    
            
            $fur = $request['fur'];
            if(empty($fur))$fur = "";
    
            $saturacion = $request['saturacion'];
            if(empty($saturacion))$saturacion = "";
    
            $tem = $request['tem'];
            if(empty($tem))$tem = "";
    
            $pa = $request['pa'];
            if(empty($pa))$pa = "";
    
            $fc = $request['fc'];
            if(empty($fc))$fc = "";
    
            
            $fr = $request['fr'];
            if(empty($fr))$fr = "";
    
            $peso = $request['peso'];
            if(empty($peso))$peso = "";
    
            
            $talla = $request['talla'];
            if(empty($talla))$talla = "";
    
            $imc = $request['imc'];
            if(empty($imc))$imc = "";
    
            $saturacion = $request['saturacion'];
            if(empty($saturacion))$saturacion = "";
    
    
    
            $clinica_regional = $request['clinica_regional'];
            if(empty($clinica_regional))$clinica_regional = array();
    
            $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional,
            'so'=>2,'lat'=>$lat,'long'=>$long,
            'cie10'=>$request['cie10'],'hoja_consulta'=>array('fecha'=>$request['fecha'],
            'hora'=>$request['hora'],'edad'=>$request['edad'],'motivo_consulta'=>$request['motivo_consulta'],
            'forma_inicio'=>$request['forma_inicio'],'curso'=>$request['curso'],'tiempo_enfermedad'=>$request['tiempo_enfermedad'],
            'relato_cronologico'=>$request['relato_cronologico'],'apetito'=>$request['apetito'],
            'sed'=>$request['sed'],'suenho'=>$request['suenho'],'fur'=>$fur,'ram'=>$request['ram'],
            'orina'=>$request['orina'],'deposiciones'=>$request['deposiciones'],'tem'=>$request['tem'],
            'pa'=>$request['pa'],'fc'=>$request['fc'],'fr'=>$request['fr'],'peso'=>$request['peso'],
            'talla'=>$request['talla'],'imc'=>$request['imc'],'saturacion'=>$saturacion,'clinica_regional'=>$clinica_regional)];
            $dataU = $object = json_decode(json_encode($data), FALSE);
            $request->session()->put(['diagnostico'=>$dataU]);
    
            return 'ok'; 
        }else{
            return 'Erro la sesion del paciente no existe, intente nuevamente';
        }
       
    }

    
    //diagnostico
    public function diagnostico(Request $request){
        $diagnostico = json_decode($this->getDiagnosticos($request));
        $histori=$this->HistoriaClinicaController->getHistoria($request);
        $sed = $this->getJsonSed($request);
        $sueno = $this->getJsonSueno($request);
        $dispo=$this->getJsonDisposicion($request);
        $orina=$this->getJsonOrina($request);
        $apetito=$this->getJsonApetito($request);
        $clinic=$this->getJsonCliniR($request);
      
        
        //print_r(json_encode(session('diagnostico')));

        return view('registroAtencion/diagnostico',['diagnostico'=>$diagnostico,
        'sed'=>$sed,'sueno'=>$sueno,'dispo'=>$dispo,'orina'=>$orina,'apetito'=>$apetito,
        'clinic'=>$clinic,
        'histori'=>$histori]);
    }

    //getJsonSed
    public function getJsonSed(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_sed';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getJsonSueno
    public function getJsonSueno(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_suenho';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getJsonDisposicion
    public function getJsonDisposicion(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_deposicion';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }
    
    //getJsonOrina
    public function getJsonOrina(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_orina';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getJsonApetito
    public function getJsonApetito(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_desplegable_apetito';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }

    //getJsonCliniR
    public function getJsonCliniR(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $query = $request['query'];
        if(empty($query))$query = "";
        $data=['so'=>2,'lat'=>$lat,'long'=>$long,'query'=>$query];
        $url = $this->server2.'api/json_clinicaregional';
        $result = $this->getServicesGET($url,json_encode($data),session('medico')->data[0]->token);
        return $result;
    }




}
