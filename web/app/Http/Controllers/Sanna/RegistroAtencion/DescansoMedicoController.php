<?php

namespace App\Http\Controllers\Sanna\RegistroAtencion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Providers\conection; 

class DescansoMedicoController extends Controller
{
    use conection;

    protected $HistoriaClinicaController;
    protected $DiagnosticoController;

    public function __construct(HistoriaClinicaController $HistoriaClinicaController,
    DiagnosticoController $DiagnosticoController)
    {
       $this->HistoriaClinicaController = $HistoriaClinicaController;
       $this->DiagnosticoController = $DiagnosticoController;

    }

    //CreateDescansoMedicoConsulta
    public function CreateDescansoMedicoConsulta(Request $request){
      
        $url = $this->server2.'api/generar_descansomedico_consulta';
        $result = $this->getServices($url,json_encode($data),session('medico')->data[0]->token);
        return json_encode($result);
    }

    public function saveDescansoSession(Request $request){
        $lat='-12.0431800';
        $long='-77.0282400';
        $data=['idprofesional'=>session('medico')->data[0]->info[0]->idprofesional, 'so'=>2,'lat'=>$lat,'long'=>$long,
        'presuncion_diagnostica'=>$request['presuncion_diagnostica'],'periodo'=>$request['periodo']];
        
        $dataU = $object = json_decode(json_encode($data), FALSE);
        $request->session()->put(['descanso'=>$dataU]);
        return "ok";
    }

    //descansoMedico
    public function descansoMedico(Request $request){
        $histori=$this->HistoriaClinicaController->getHistoria($request);
        $dianostics=json_decode($this->DiagnosticoController->getDiagnosticos($request));
        //print_r(json_encode($dianostics));
        return view('registroAtencion/descansoMedico',['histori'=>$histori,'dianostics'=>$dianostics]);
    }

}
